const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const header = document.querySelector('[data-header]');
const toggle = document.querySelector('[data-nav-toggle]');
const nav = document.querySelector('[data-nav]');

const syncHeader = () => {
    if (!header) {
        return;
    }

    header.classList.toggle('is-scrolled', window.scrollY > 8);
};

syncHeader();
window.addEventListener('scroll', syncHeader, { passive: true });

toggle?.addEventListener('click', () => {
    const open = nav?.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    document.body.classList.toggle('overflow-hidden', Boolean(open));
});

nav?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
        nav.classList.remove('is-open');
        toggle?.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('overflow-hidden');
    });
});

const flash = document.querySelector('.flash');
if (flash) {
    window.setTimeout(() => {
        flash.classList.add('is-leaving');
        window.setTimeout(() => flash.remove(), 350);
    }, 4200);
}

const wrapText3d = (root) => {
    if (prefersReducedMotion || root.dataset.split === 'true') {
        return;
    }

    let charIndex = 0;

    const segmentGraphemes = (text) => {
        if (typeof Intl !== 'undefined' && typeof Intl.Segmenter === 'function') {
            return [...new Intl.Segmenter(undefined, { granularity: 'grapheme' }).segment(text)].map((item) => item.segment);
        }

        return [...text];
    };

    const wrapNode = (node, extraClass = '') => {
        if (node.nodeType === Node.TEXT_NODE) {
            const text = node.textContent ?? '';
            if (!text.length) {
                return;
            }

            const fragment = document.createDocumentFragment();
            const words = text.split(/(\s+)/);

            words.forEach((part) => {
                if (!part.length) {
                    return;
                }

                if (/^\s+$/.test(part)) {
                    const space = document.createElement('span');
                    space.className = 'char-space';
                    space.setAttribute('aria-hidden', 'true');
                    space.textContent = ' ';
                    fragment.appendChild(space);
                    return;
                }

                const word = document.createElement('span');
                word.className = 'word';
                word.setAttribute('aria-hidden', 'true');

                segmentGraphemes(part).forEach((letter) => {
                    const char = document.createElement('span');
                    char.className = `char ${extraClass}`.trim();
                    char.style.setProperty('--char-i', String(charIndex));
                    char.textContent = letter;
                    word.appendChild(char);
                    charIndex += 1;
                });

                fragment.appendChild(word);
            });

            node.replaceWith(fragment);
            return;
        }

        if (node.nodeType !== Node.ELEMENT_NODE) {
            return;
        }

        const element = node;
        const mintClass = element.matches('em, .text-mint, .text-3d--mint') ? 'text-3d--mint' : extraClass;

        [...element.childNodes].forEach((child) => wrapNode(child, mintClass));
    };

    [...root.childNodes].forEach((child) => wrapNode(child));
    root.setAttribute('aria-label', root.textContent?.replace(/\s+/g, ' ').trim() ?? '');
    root.dataset.split = 'true';
};

document.querySelectorAll('[data-text-3d]').forEach((el) => {
    wrapText3d(el);
});

const revealElements = document.querySelectorAll('[data-reveal]');
const cascadeRoots = document.querySelectorAll('[data-cascade]');
const cascadeItems = new Set();

cascadeRoots.forEach((root) => {
    root.querySelectorAll('[data-reveal]').forEach((item) => cascadeItems.add(item));
});

const markVisible = (el) => {
    el.classList.add('is-visible');
};

const runCascade = (root) => {
    if (root.dataset.cascaded === 'true') {
        return;
    }

    root.dataset.cascaded = 'true';
    const items = [...root.querySelectorAll('[data-reveal]')];
    const step = Number(root.dataset.cascadeStep || 110);
    const start = Number(root.dataset.cascadeStart || 80);

    items.forEach((item, index) => {
        item.style.setProperty('--reveal-delay', '0ms');
        window.setTimeout(() => markVisible(item), start + index * step);
    });
};

if (prefersReducedMotion) {
    revealElements.forEach(markVisible);
} else if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                markVisible(entry.target);
                observer.unobserve(entry.target);
            });
        },
        {
            threshold: 0.12,
            rootMargin: '0px 0px -6% 0px',
        },
    );

    revealElements.forEach((el) => {
        if (cascadeItems.has(el)) {
            return;
        }

        observer.observe(el);
    });

    const cascadeObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                runCascade(entry.target);
                cascadeObserver.unobserve(entry.target);
            });
        },
        {
            threshold: 0.08,
            rootMargin: '0px 0px -4% 0px',
        },
    );

    cascadeRoots.forEach((root) => cascadeObserver.observe(root));
} else {
    revealElements.forEach(markVisible);
}

document.querySelectorAll('[data-parallax]').forEach((el) => {
    if (prefersReducedMotion) {
        return;
    }

    const intensity = Number(el.dataset.parallax || 12);

    const onScroll = () => {
        const rect = el.getBoundingClientRect();
        const progress = (window.innerHeight - rect.top) / (window.innerHeight + rect.height);
        const offset = (progress - 0.5) * intensity;
        el.style.transform = `translate3d(0, ${offset.toFixed(2)}px, 0)`;
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
});

document.querySelectorAll('[data-spotlight]').forEach((zone) => {
    if (prefersReducedMotion) {
        return;
    }

    zone.addEventListener('pointermove', (event) => {
        const rect = zone.getBoundingClientRect();
        const x = ((event.clientX - rect.left) / rect.width) * 100;
        const y = ((event.clientY - rect.top) / rect.height) * 100;
        zone.style.setProperty('--spot-x', `${x.toFixed(2)}%`);
        zone.style.setProperty('--spot-y', `${y.toFixed(2)}%`);
    });
});

document.querySelectorAll('[data-accordion]').forEach((details) => {
    const summary = details.querySelector('summary');
    const panel = details.querySelector('.accordion-panel');

    if (!summary || !panel) {
        return;
    }

    const syncOpenClass = () => {
        details.classList.toggle('is-open', details.open);
    };

    syncOpenClass();

    if (prefersReducedMotion) {
        details.addEventListener('toggle', syncOpenClass);
        return;
    }

    if (details.open) {
        details.classList.add('is-open');
    }

    summary.addEventListener('click', (event) => {
        event.preventDefault();

        if (details.classList.contains('is-open')) {
            details.classList.remove('is-open');
            panel.addEventListener(
                'transitionend',
                (endEvent) => {
                    if (endEvent.propertyName !== 'grid-template-rows' && endEvent.target !== panel) {
                        return;
                    }
                    details.open = false;
                },
                { once: true },
            );
            window.setTimeout(() => {
                if (!details.classList.contains('is-open')) {
                    details.open = false;
                }
            }, 520);
            return;
        }

        details.open = true;
        details.classList.remove('is-open');
        void panel.offsetHeight;
        requestAnimationFrame(() => {
            details.classList.add('is-open');
        });
    });
});

/* ——— Motion polish ——— */

const progressBar = document.querySelector('[data-scroll-progress]');
const cursorGlow = document.querySelector('[data-cursor-glow]');

const updateScrollProgress = () => {
    if (!progressBar) {
        return;
    }

    const doc = document.documentElement;
    const max = doc.scrollHeight - window.innerHeight;
    const ratio = max > 0 ? window.scrollY / max : 0;
    progressBar.style.transform = `scaleX(${Math.min(1, Math.max(0, ratio)).toFixed(4)})`;
};

updateScrollProgress();
window.addEventListener('scroll', updateScrollProgress, { passive: true });
window.addEventListener('resize', updateScrollProgress, { passive: true });

if (!prefersReducedMotion && cursorGlow) {
    let glowX = window.innerWidth / 2;
    let glowY = window.innerHeight / 2;
    let targetX = glowX;
    let targetY = glowY;
    let glowFrame = 0;

    const tickGlow = () => {
        glowX += (targetX - glowX) * 0.12;
        glowY += (targetY - glowY) * 0.12;
        cursorGlow.style.transform = `translate3d(${glowX}px, ${glowY}px, 0)`;
        glowFrame = requestAnimationFrame(tickGlow);
    };

    window.addEventListener(
        'pointermove',
        (event) => {
            targetX = event.clientX;
            targetY = event.clientY;
            cursorGlow.classList.add('is-on');
        },
        { passive: true },
    );

    window.addEventListener('pointerleave', () => cursorGlow.classList.remove('is-on'), { passive: true });
    glowFrame = requestAnimationFrame(tickGlow);
    window.addEventListener('beforeunload', () => cancelAnimationFrame(glowFrame));
}

if (!prefersReducedMotion) {
    document.querySelectorAll('.btn, .chip').forEach((el) => {
        el.addEventListener('pointermove', (event) => {
            const rect = el.getBoundingClientRect();
            const x = event.clientX - rect.left - rect.width / 2;
            const y = event.clientY - rect.top - rect.height / 2;
            el.style.setProperty('--mx', `${(x * 0.18).toFixed(1)}px`);
            el.style.setProperty('--my', `${(y * 0.18).toFixed(1)}px`);
        });

        el.addEventListener('pointerleave', () => {
            el.style.setProperty('--mx', '0px');
            el.style.setProperty('--my', '0px');
        });
    });
}

document.querySelectorAll('[data-stagger]').forEach((root) => {
    const step = Number(root.dataset.stagger || 70);
    [...root.children].forEach((child, index) => {
        child.style.setProperty('--stagger-i', String(index));
        child.style.setProperty('--stagger-delay', `${index * step}ms`);
    });
    root.classList.add('is-stagger-ready');
});

if (header && !prefersReducedMotion) {
    header.classList.add('header-enter');
}

document.querySelectorAll('.marquee').forEach((el) => {
    el.addEventListener('pointerenter', () => el.classList.add('is-paused'));
    el.addEventListener('pointerleave', () => el.classList.remove('is-paused'));
});
