<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Atelier Admin',
            'email' => 'admin@beautypantry.com',
            'password' => 'BeautyPantry!2026',
            'role' => 'admin',
        ]);

        $customer = User::factory()->create([
            'name' => 'Hnin Yu',
            'email' => 'guest@beautypantry.com',
            'password' => 'BeautyPantry!2026',
            'role' => 'customer',
        ]);

        $collections = [
            ['name' => 'Skincare', 'slug' => 'skincare', 'eyebrow' => 'Complexion', 'description' => 'Serums, creams, and rinses composed for calm, luminous skin.', 'sort' => 1],
            ['name' => 'Makeup', 'slug' => 'makeup', 'eyebrow' => 'Color', 'description' => 'Soft pigment and precise lines. Color that never shouts.', 'sort' => 2],
            ['name' => 'Fragrance', 'slug' => 'fragrance', 'eyebrow' => 'Scent', 'description' => 'Green, quiet perfumes meant to sit close to the skin.', 'sort' => 3],
            ['name' => 'Body', 'slug' => 'body', 'eyebrow' => 'Beyond the face', 'description' => 'Oils and mists that finish the ritual past the jawline.', 'sort' => 4],
            ['name' => 'Hair', 'slug' => 'hair', 'eyebrow' => 'Silk', 'description' => 'Gentle cleanses for hair that prefers softness over volume.', 'sort' => 5],
            ['name' => 'Gifts', 'slug' => 'gifts', 'eyebrow' => 'Atelier sets', 'description' => 'Edited sets, wrapped as if they were letters.', 'sort' => 6],
        ];

        $categories = collect($collections)->mapWithKeys(function (array $collection) {
            $category = Category::create($collection);

            return [$category->slug => $category];
        });

        $products = [
            [
                'category' => 'skincare',
                'name' => 'Dew Veil Serum',
                'subtitle' => 'A water-light veil for uneven tone',
                'description' => 'A featherweight serum that settles into skin like morning humidity. Niacinamide and rice ferment soften the look of texture without a heavy finish.',
                'story' => 'Dew Veil was the first formula in the pantry — made for Yangon heat, where rich creams feel like too much before noon.',
                'ingredients' => 'Rice ferment, niacinamide, panthenol, green tea, hyaluronic acid, aloe.',
                'how_to' => 'Press four drops over damp skin each morning. Follow with Silk Hour if the air is dry.',
                'price' => 68000,
                'compare_price' => null,
                'stock' => 24,
                'sku' => 'BP-SER-01',
                'is_featured' => true,
                'is_bestseller' => true,
                'badge' => 'Bestseller',
                'image' => 'images/products/dew-veil.jpg',
            ],
            [
                'category' => 'skincare',
                'name' => 'Silk Hour Cream',
                'subtitle' => 'A cushion of moisture for evening',
                'description' => 'A quiet cream with squalane and ceramides. It leaves a soft satin surface, never a film.',
                'story' => 'Named for the hour after sunset, when the skin finally exhales.',
                'ingredients' => 'Squalane, ceramide complex, shea, centella, vitamin E.',
                'how_to' => 'Warm a pearl between the fingers and press over serum at night.',
                'price' => 92000,
                'compare_price' => 110000,
                'stock' => 18,
                'sku' => 'BP-CRM-02',
                'is_featured' => true,
                'is_bestseller' => false,
                'badge' => 'Atelier',
                'image' => 'images/products/silk-hour.jpg',
            ],
            [
                'category' => 'skincare',
                'name' => 'Jade Rinse Cleanser',
                'subtitle' => 'A milky cleanse with a cool finish',
                'description' => 'A low-foam cleanser that lifts the day without stripping. Cucumber water and amino surfactants keep the barrier comfortable.',
                'story' => 'The rinse is meant to feel like cool stone — brief, clean, and done.',
                'ingredients' => 'Amino surfactants, cucumber distillate, glycerin, allantoin.',
                'how_to' => 'Massage over dry or damp skin, then rinse with lukewarm water.',
                'price' => 38000,
                'compare_price' => null,
                'stock' => 40,
                'sku' => 'BP-CLN-03',
                'is_featured' => false,
                'is_bestseller' => true,
                'badge' => null,
                'image' => 'images/products/jade-rinse.jpg',
            ],
            [
                'category' => 'skincare',
                'name' => 'Nocturne Face Oil',
                'subtitle' => 'Five botanical oils, pressed for night',
                'description' => 'A spare facial oil of meadowfoam, sacha inchi, and a trace of vetiver. It seals the evening ritual with a quiet sheen.',
                'story' => 'Nocturne is for the nights you skip everything else.',
                'ingredients' => 'Meadowfoam, sacha inchi, rosehip, jojoba, vetiver.',
                'how_to' => 'Three drops, pressed in as the last step. Avoid the immediate eye area.',
                'price' => 78000,
                'compare_price' => null,
                'stock' => 16,
                'sku' => 'BP-OIL-04',
                'is_featured' => true,
                'is_bestseller' => false,
                'badge' => 'Night',
                'image' => 'images/products/nocturne.jpg',
            ],
            [
                'category' => 'makeup',
                'name' => 'Petal Veil Balm',
                'subtitle' => 'A stain of color for lips and cheeks',
                'description' => 'A cream balm in a bruised-rose shade. It melts with the warmth of skin and can travel from mouth to cheek.',
                'story' => 'One balm, so the face never looks assembled from too many drawers.',
                'ingredients' => 'Candelilla, jojoba, berry pigment, vitamin E.',
                'how_to' => 'Tap on with a fingertip. Layer for a deeper petal.',
                'price' => 32000,
                'compare_price' => null,
                'stock' => 30,
                'sku' => 'BP-BLM-05',
                'is_featured' => true,
                'is_bestseller' => true,
                'badge' => 'New',
                'image' => 'images/products/petal-balm.jpg',
            ],
            [
                'category' => 'makeup',
                'name' => 'Lumière Skin Tint',
                'subtitle' => 'Sheer coverage with a lit finish',
                'description' => 'A skin tint that evens, then disappears. Light-reflecting minerals give a fresh, undecorated glow.',
                'story' => 'Lumière is makeup for people who prefer to look rested rather than painted.',
                'ingredients' => 'Mineral pigments, glycerin, niacinamide, squalane.',
                'how_to' => 'Shake, then press a small amount from the center of the face outward.',
                'price' => 54000,
                'compare_price' => null,
                'stock' => 22,
                'sku' => 'BP-TNT-06',
                'is_featured' => false,
                'is_bestseller' => true,
                'badge' => null,
                'image' => 'images/products/lumiere.jpg',
            ],
            [
                'category' => 'makeup',
                'name' => 'Soft Line Pencil',
                'subtitle' => 'A precise line that still looks soft',
                'description' => 'A cocoa-brown pencil with a creamy core. It draws a line you can smudge into a shadow in one gesture.',
                'story' => 'Kept short on purpose. The pantry does not believe in a dozen liners.',
                'ingredients' => 'Plant waxes, iron oxides, vitamin E.',
                'how_to' => 'Line close to the lash, then soften with a fingertip.',
                'price' => 24000,
                'compare_price' => null,
                'stock' => 4,
                'sku' => 'BP-PEN-07',
                'is_featured' => false,
                'is_bestseller' => false,
                'badge' => 'Low',
                'image' => 'images/products/soft-line.jpg',
            ],
            [
                'category' => 'fragrance',
                'name' => 'Atelier Mist',
                'subtitle' => 'Neroli, tea, and wet stone',
                'description' => 'A fine mist meant for pulse points and the inside of a collar. It opens green and dries down to clean tea.',
                'story' => 'The scent of the studio after the floors are washed.',
                'ingredients' => 'Neroli, white tea, petitgrain, musk accord.',
                'how_to' => 'Mist from an arm’s length. Do not rub.',
                'price' => 86000,
                'compare_price' => null,
                'stock' => 14,
                'sku' => 'BP-MST-08',
                'is_featured' => true,
                'is_bestseller' => false,
                'badge' => null,
                'image' => 'images/products/atelier-mist.jpg',
            ],
            [
                'category' => 'fragrance',
                'name' => 'Verde Eau',
                'subtitle' => 'A green perfume that stays close',
                'description' => 'Fig leaf, crushed stems, and a pale cedar base. Verde is composed to be noticed only by the person beside you.',
                'story' => 'Our signature scent, bottled in a deep flacon for evenings.',
                'ingredients' => 'Fig leaf, galbanum, cedar, soft musk.',
                'how_to' => 'One spray at the wrist, one at the collar.',
                'price' => 128000,
                'compare_price' => null,
                'stock' => 11,
                'sku' => 'BP-PRF-09',
                'is_featured' => true,
                'is_bestseller' => true,
                'badge' => 'Signature',
                'image' => 'images/products/verde-eau.jpg',
            ],
            [
                'category' => 'body',
                'name' => 'Cashmere Body Oil',
                'subtitle' => 'Warm oil for shoulders and shins',
                'description' => 'A slow body oil scented with a thread of sandalwood. It leaves skin supple and lightly polished.',
                'story' => 'Use it when the air-conditioning has been unkind.',
                'ingredients' => 'Sweet almond, camellia, sandalwood, vitamin E.',
                'how_to' => 'Smooth over damp skin after bathing.',
                'price' => 64000,
                'compare_price' => null,
                'stock' => 19,
                'sku' => 'BP-BDY-10',
                'is_featured' => false,
                'is_bestseller' => false,
                'badge' => null,
                'image' => 'images/products/cashmere.jpg',
            ],
            [
                'category' => 'hair',
                'name' => 'Rice Silk Shampoo',
                'subtitle' => 'A gentle wash for soft hair',
                'description' => 'A sulfate-free shampoo with rice protein. It cleans the scalp and leaves lengths feeling like rinsed silk.',
                'story' => 'Formulated for hair that is washed often in a humid city.',
                'ingredients' => 'Mild surfactants, rice protein, panthenol, chamomile.',
                'how_to' => 'Lather at the scalp, let the rinse travel through the lengths.',
                'price' => 42000,
                'compare_price' => null,
                'stock' => 27,
                'sku' => 'BP-HR-11',
                'is_featured' => false,
                'is_bestseller' => false,
                'badge' => null,
                'image' => 'images/products/rice-silk.jpg',
            ],
            [
                'category' => 'gifts',
                'name' => 'The Quiet Set',
                'subtitle' => 'Serum, cream, and oil — edited',
                'description' => 'The evening ritual in one box: Dew Veil, a travel Silk Hour, and a vial of Nocturne. Wrapped in ivory paper.',
                'story' => 'Our most requested gift, for someone who already owns enough things.',
                'ingredients' => 'See each formula inside. Full sizes sold separately.',
                'how_to' => 'Begin with serum, seal with cream, finish with two drops of oil.',
                'price' => 165000,
                'compare_price' => 198000,
                'stock' => 9,
                'sku' => 'BP-SET-12',
                'is_featured' => true,
                'is_bestseller' => true,
                'badge' => 'Gift',
                'image' => 'images/products/quiet-set.jpg',
            ],
        ];

        $created = collect();

        foreach ($products as $product) {
            $category = $categories[$product['category']];
            unset($product['category']);
            $product['category_id'] = $category->id;
            $product['slug'] = str($product['name'])->slug()->toString();
            $created->push(Product::create($product));
        }

        $dew = $created->firstWhere('sku', 'BP-SER-01');
        $verde = $created->firstWhere('sku', 'BP-PRF-09');

        $order = Order::create([
            'user_id' => $customer->id,
            'number' => 'BP-260923-DEMO',
            'status' => 'paid',
            'customer_name' => $customer->name,
            'email' => $customer->email,
            'phone' => '09 420 118 220',
            'city' => 'Yangon',
            'address' => 'Bahan Township',
            'notes' => 'Please leave with the building office.',
            'subtotal' => $dew->price + $verde->price,
            'shipping' => 0,
            'total' => $dew->price + $verde->price,
        ]);

        $order->items()->createMany([
            ['product_id' => $dew->id, 'name' => $dew->name, 'price' => $dew->price, 'quantity' => 1],
            ['product_id' => $verde->id, 'name' => $verde->name, 'price' => $verde->price, 'quantity' => 1],
        ]);

        Inquiry::create([
            'name' => 'Su Myat',
            'email' => 'su.myat@example.com',
            'phone' => '09 250 441 908',
            'subject' => 'Shade for Lumière',
            'message' => 'Could you advise a Lumière shade for light-medium skin with warm undertones? I prefer something very sheer.',
            'is_read' => false,
        ]);

        unset($admin);
    }
}
