<?php
// index.php – main KickVibe page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KickVibe</title>
    <!-- your CSS here -->
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickVibe | Urban Footwear Store</title>
    <meta name="description" content="Trendy, comfortable, and high-quality shoes for the modern generation.">
    <style>
        /* --- 1. CORE DESIGN SYSTEM --- */
        :root {
            /* Brand Colors - Standard */
            --brand-primary: #ccff00;      /* Neon Volt */
            --brand-secondary: #00f0ff;    /* Cyber Blue */
            --brand-dark: #0a0a0a;         /* Deep Black */
            
            --surface-dark: #141414;       /* Card Background */
            --surface-light: #222222;      /* Hover States */
            --text-main: #ffffff;
            --text-muted: #888888;
            
            /* Spacing & Layout */
            --container-width: 1200px;
            --header-height: 70px;
            --radius: 8px;
            
            /* Animation */
            --ease: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* --- 2. RESET & BASE --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--brand-dark);
            color: var(--text-main);
            overflow-x: hidden;
            padding-top: var(--header-height);
        }

        a { text-decoration: none; color: inherit; cursor: pointer; }
        ul { list-style: none; }
        button { cursor: pointer; border: none; font-family: inherit; }
        
        /* Utility Classes */
        .container { max-width: var(--container-width); margin: 0 auto; padding: 0 20px; }
        .flex { display: flex; align-items: center; }
        .grid { display: grid; gap: 20px; }
        .hidden { display: none !important; }
        .text-primary { color: var(--brand-primary); }
        .text-center { text-align: center; }

        /* --- 3. UI COMPONENTS --- */
        
        /* Buttons */
        .btn {
            background: var(--brand-primary);
            color: black;
            padding: 12px 24px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 4px;
            transition: transform 0.2s var(--ease);
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .btn:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(204, 255, 0, 0.3); 
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--brand-primary);
            color: var(--brand-primary);
        }
        .btn-outline:hover { background: var(--brand-primary); color: black; }

        .btn-icon {
            background: var(--surface-light);
            color: white;
            width: 40px; height: 40px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            transition: 0.2s;
        }
        .btn-icon:hover { background: var(--brand-primary); color: black; }
        .btn-icon.active { background: var(--brand-secondary); color: black; }
        
        .badge {
            position: absolute;
            top: -5px; right: -5px;
            background: var(--brand-secondary);
            color: black;
            font-size: 10px;
            font-weight: bold;
            width: 18px; height: 18px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        /* Forms */
        .input {
            width: 100%;
            padding: 12px;
            background: var(--surface-dark);
            border: 1px solid #333;
            color: white;
            border-radius: 4px;
        }
        .input:focus { outline: none; border-color: var(--brand-primary); }
        .input.error { border-color: #ff4444; }

        /* --- 4. HEADER --- */
        header {
            position: fixed; top: 0; left: 0; right: 0;
            height: var(--header-height);
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #222;
            z-index: 1000;
        }
        
        .nav-content { justify-content: space-between; height: 100%; }
        
        .logo { font-size: 1.5rem; font-weight: 900; letter-spacing: -1px; font-style: italic; position: relative; }
        .logo span { color: var(--brand-primary); }

        .nav-links { gap: 30px; }
        .nav-links a { font-size: 0.9rem; font-weight: 500; color: var(--text-muted); transition: 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: white; }

        .nav-actions { gap: 15px; }

        /* --- 5. PAGE ROUTING SYSTEM --- */
        .view {
            display: none;
            animation: fadeIn 0.4s var(--ease);
            min-height: 80vh;
        }
        .view.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* --- 6. HOME VIEW --- */
        .hero {
            height: 500px;
            background: radial-gradient(circle at 70% 50%, #222, #0a0a0a);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-content { position: relative; z-index: 2; max-width: 600px; }
        .hero h1 { font-size: 4rem; line-height: 1; margin-bottom: 20px; font-weight: 900; }
        .hero p { font-size: 1.2rem; color: var(--text-muted); margin-bottom: 30px; }
        
        /* --- 7. CATALOG/SHOP VIEW --- */
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            margin-top: 30px;
        }
        
        .product-card {
            background: var(--surface-dark);
            border-radius: var(--radius);
            overflow: hidden;
            transition: 0.3s;
            border: 1px solid transparent;
            position: relative;
        }
        .product-card:hover { 
            border-color: var(--brand-primary); 
            transform: translateY(-5px); 
        }
        
        .card-img-box {
            height: 220px;
            background: #1a1a1a;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .shoe-sprite {
            width: 80%; height: 50%;
            background: linear-gradient(90deg, #444, #666);
            border-radius: 10px 40px 10px 10px;
            position: relative;
        }
        .shoe-sprite::before { /* Sole */
            content:''; position: absolute; bottom: -10px; left: 0; width: 100%; height: 10px; background: white; border-radius: 4px;
        }

        .card-details { padding: 20px; }
        .card-cat { font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; }
        .card-title { font-size: 1.1rem; margin: 5px 0 10px; font-weight: 700; }
        .card-footer { display: flex; justify-content: space-between; align-items: center; }

        /* --- 8. PRODUCT DETAIL VIEW (UNIQUE FEATURES) --- */
        .detail-layout {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
            margin-top: 20px;
        }

        .preview-container {
            height: 500px;
            background: #1a1a1a;
            border-radius: 12px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: background 0.5s ease;
        }

        /* Feature: Scene Switching Backgrounds */
        .scene-studio { background: #1a1a1a; }
        .scene-street { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), repeating-linear-gradient(45deg, #333 0, #333 10px, #222 10px, #222 20px); }
        .scene-night { background: radial-gradient(circle at 50% 50%, #1a0b2e, #000); }

        /* Feature: Motion Animation */
        .motion-active .shoe-large {
            animation: walking 1s infinite alternate ease-in-out;
        }
        @keyframes walking {
            0% { transform: translateY(0) rotate(0deg) scale(1.5); }
            100% { transform: translateY(-20px) rotate(-5deg) scale(1.5); }
        }

        .shoe-large {
            width: 300px; height: 140px;
            background: linear-gradient(135deg, #555, #777);
            border-radius: 20px 60px 20px 20px;
            position: relative;
            transform: scale(1.5);
            transition: transform 0.5s;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .shoe-large::after { /* Sole */
            content:''; position: absolute; bottom: -15px; left: 0; width: 100%; height: 15px; background: white; border-radius: 5px;
        }

        .controls-bar {
            position: absolute;
            bottom: 20px;
            display: flex;
            gap: 10px;
            background: rgba(0,0,0,0.8);
            padding: 8px;
            border-radius: 50px;
        }

        .feature-tag {
            background: #222;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            color: #ccc;
            border: 1px solid #333;
        }
        .feature-tag b { color: var(--brand-primary); display: block; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 2px; }

        /* --- 9. COMMUNITY (UGC) SECTION --- */
        .ugc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .video-card {
            aspect-ratio: 9 / 16;
            background: #222;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .video-card:hover { transform: translateY(-5px); }

        .video-thumb {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        .video-card:hover .video-thumb { opacity: 0.4; }

        .play-btn-overlay {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem; color: white;
            opacity: 0.8;
            text-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }

        .video-info {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
        }
        .user-tag { font-size: 0.9rem; font-weight: bold; color: var(--brand-primary); }
        .video-desc { font-size: 0.85rem; color: #ddd; margin-top: 5px; line-height: 1.4; }


        /* --- 10. AUTH STYLES --- */
        .auth-container { display: flex; justify-content: center; align-items: center; min-height: 60vh; }
        .auth-card { background: var(--surface-dark); padding: 40px; border-radius: 12px; width: 100%; max-width: 400px; border: 1px solid #333; box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
        .auth-card h2 { margin-bottom: 20px; font-size: 2rem; }
        .auth-form { display: flex; flex-direction: column; gap: 15px; }
        .auth-switch { margin-top: 20px; text-align: center; font-size: 0.9rem; color: var(--text-muted); }
        .auth-switch span { color: var(--brand-primary); cursor: pointer; text-decoration: underline; }

        .profile-header { background: var(--surface-dark); padding: 30px; border-radius: 12px; margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between; border: 1px solid #333; }
        .avatar { width: 80px; height: 80px; background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; color: black; margin-right: 20px; }

        /* --- 11. CHECKOUT STYLES --- */
        .payment-options { display: flex; flex-direction: column; gap: 10px; margin-top: 15px; }
        .payment-card { background: var(--surface-light); padding: 15px; border-radius: 8px; border: 1px solid #333; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: 0.2s; }
        .payment-card:hover, .payment-card.selected { border-color: var(--brand-primary); background: #2a2a2a; }
        .payment-card input { accent-color: var(--brand-primary); }

        /* --- 12. COMPARE STYLES --- */
        .compare-grid { display: grid; grid-template-columns: 150px 1fr 1fr; gap: 10px; margin-top: 30px; align-items: center; }
        .compare-header { font-weight: bold; color: var(--text-muted); padding: 15px; border-bottom: 1px solid #333; }
        .compare-cell { padding: 15px; border-bottom: 1px solid #333; text-align: center; }
        .compare-cell:nth-child(2), .compare-cell:nth-child(3) { background: rgba(255,255,255,0.02); }
        
        /* --- 13. TRACKING STYLES --- */
        .order-card { background: var(--surface-dark); border: 1px solid #333; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
        .track-container { display: flex; justify-content: space-between; align-items: center; margin-top: 30px; position: relative; }
        .track-line-bg { position: absolute; top: 20px; left: 0; width: 100%; height: 4px; background: #333; z-index: 0; }
        .track-line-fill { position: absolute; top: 20px; left: 0; height: 4px; background: var(--brand-primary); z-index: 1; transition: width 0.5s ease; }
        
        .track-step { z-index: 2; display: flex; flex-direction: column; align-items: center; text-align: center; min-width: 80px; }
        .track-circle { width: 40px; height: 40px; border-radius: 50%; background: #222; border: 2px solid #444; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: 0.3s; }
        .track-label { margin-top: 10px; font-size: 0.8rem; color: #666; font-weight: bold; }
        
        .track-step.active .track-circle { background: var(--brand-primary); border-color: var(--brand-primary); color: black; box-shadow: 0 0 15px rgba(204,255,0,0.4); }
        .track-step.active .track-label { color: white; }
        
        /* --- 14. MOBILE --- */
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero h1 { font-size: 2.5rem; }
            .detail-layout { grid-template-columns: 1fr; }
            .preview-container { height: 300px; }
            .shoe-large { transform: scale(1); }
            .profile-header { flex-direction: column; text-align: center; gap: 20px; }
            .avatar { margin-right: 0; }
            .compare-grid { display: flex; flex-direction: column; }
            .compare-header { background: #222; margin-top: 10px; }
            .track-label { font-size: 0.6rem; }
            .track-circle { width: 30px; height: 30px; font-size: 0.9rem; }
        }

        /* --- 15. CONTACT WIDGET --- */
        .contact-widget { position: fixed; bottom: 30px; right: 30px; z-index: 3000; }
        .contact-menu { 
            position: absolute; bottom: 100%; right: 0; margin-bottom: 15px; 
            background: var(--surface-dark); border: 1px solid #333; border-radius: 8px; padding: 10px; 
            display: flex; flex-direction: column; gap: 8px; min-width: 160px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); 
            animation: slideUp 0.3s var(--ease); 
        }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .contact-item { display: flex; align-items: center; gap: 10px; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 4px; transition: 0.2s; font-weight: 500; }
        .contact-item:hover { background: var(--brand-primary); color: black; }
        .contact-fab { 
            width: 60px; height: 60px; border-radius: 50%; background: var(--brand-primary); color: black; font-size: 24px; 
            display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(204, 255, 0, 0.4); 
            border: none; cursor: pointer; transition: 0.2s;
        }
        .contact-fab:hover { background: var(--brand-secondary); }

        /* --- 16. NOTIFICATIONS --- */
        .toast-container { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 4000; display: flex; flex-direction: column; gap: 10px; pointer-events: none; }
        .toast { background: rgba(20, 20, 20, 0.95); backdrop-filter: blur(10px); border: 1px solid var(--brand-primary); color: white; padding: 15px 25px; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); animation: toastIn 0.4s var(--ease); display: flex; align-items: center; gap: 12px; font-weight: 600; min-width: 300px; justify-content: center; }
        .toast.error { border-color: #ff4444; background: rgba(40, 10, 10, 0.95); }
        @keyframes toastIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* --- 17. HELP WIDGET & MODAL --- */
        .help-widget { position: fixed; bottom: 30px; left: 30px; z-index: 3000; }
        .help-btn { 
            background: #333; color: white; border: 1px solid #555; padding: 10px 20px; border-radius: 30px; 
            font-weight: bold; box-shadow: 0 4px 15px rgba(0,0,0,0.5); transition: 0.2s; font-size: 0.8rem; letter-spacing: 1px; 
        }
        .help-btn:hover { background: var(--brand-primary); color: black; border-color: var(--brand-primary); }
        
        .help-menu { 
            position: absolute; bottom: 100%; left: 0; margin-bottom: 15px;
            background: var(--surface-dark); border: 1px solid #333; border-radius: 8px; padding: 5px; 
            display: flex; flex-direction: column; gap: 5px; min-width: 200px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); 
            animation: slideUp 0.3s var(--ease); 
        }
        .help-item { background: transparent; color: #ccc; padding: 12px; text-align: left; border-radius: 4px; transition: 0.2s; width: 100%; display: block; font-size: 0.9rem; }
        .help-item:hover { background: rgba(255,255,255,0.1); color: white; }

        /* Generic Modal */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 5000; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px); animation: fadeIn 0.3s; }
        .modal-content { background: var(--surface-dark); padding: 30px; border-radius: 12px; border: 1px solid #444; width: 90%; max-width: 500px; position: relative; max-height: 80vh; overflow-y: auto; box-shadow: 0 20px 50px rgba(0,0,0,0.8); }
        .modal-close { position: absolute; top: 15px; right: 15px; background: none; color: #888; font-size: 1.2rem; cursor: pointer; transition: 0.2s; }
        .modal-close:hover { color: white; }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="flex">
        <div class="flex nav-content" style="width: 100%; padding: 0 20px;">
            <a href="#" onclick="app.nav('home')" class="logo">Kick<span>Vibe</span></a>
            
            <nav class="nav-links flex">
                <a onclick="app.nav('home')">Home</a>
                <a onclick="app.nav('shop')">Shop</a>
                <a onclick="app.nav('compare')">Compare <span id="badge-compare" class="text-primary hidden">(0)</span></a>
                <a onclick="app.nav('community')">Community</a>
                <a onclick="app.nav('account')" id="nav-account-link">Login</a>
            </nav>

            <div class="nav-actions flex">
                <button class="btn-icon" onclick="app.nav('cart')">
                    🛒 <span id="badge-cart" class="badge hidden">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        
        <!-- VIEW: Home -->
        <section id="view-home" class="view active">
            <div class="hero">
                <div class="hero-content">
                    <h1>NEXT LEVEL <br><span class="text-primary">COMFORT.</span></h1>
                    <p>Experience the "Smart Outfit" technology. <br>Preview shoes in different environments before you buy.</p>
                    <button class="btn" onclick="app.nav('shop')">Explore Collection</button>
                </div>
            </div>

            <div style="margin-top: 40px;">
                <h2 style="margin-bottom: 20px;">New Arrivals</h2>
                <div id="featured-grid" class="product-grid grid"></div>
            </div>
        </section>

        <!-- VIEW: Shop -->
        <section id="view-shop" class="view">
            <div class="flex" style="justify-content: space-between; margin-bottom: 20px; margin-top: 20px;">
                <h2>Shop All</h2>
                <input type="text" class="input" style="width: 250px;" placeholder="Search shoes..." onkeyup="app.filter(this.value)">
            </div>
            <div id="shop-grid" class="product-grid grid"></div>
        </section>

        <!-- VIEW: Product Detail -->
        <section id="view-detail" class="view">
            <button onclick="app.nav('shop')" style="color:#888; background:none; margin: 20px 0;">&larr; Back to Shop</button>
            <div id="detail-content"></div> <!-- Injected via JS -->
        </section>

        <!-- VIEW: Compare -->
        <section id="view-compare" class="view">
            <div style="margin-top: 30px;">
                <h2>Compare Shoes</h2>
                <p style="color:var(--text-muted); margin-bottom: 20px;">Select up to 2 shoes to compare their specs.</p>
                <div id="compare-content"></div>
            </div>
        </section>

        <!-- VIEW: Cart -->
        <section id="view-cart" class="view">
            <h2 style="margin: 20px 0;">Your Cart</h2>
            <div id="cart-list" class="grid"></div>
            <div style="margin-top: 20px; border-top: 1px solid #333; padding-top: 20px; text-align: right;">
                <h3>Total: <span class="text-primary" id="cart-total">$0.00</span></h3>
                <button class="btn" style="margin-top: 15px;" onclick="app.initCheckout()">Checkout</button>
            </div>
        </section>

        <!-- VIEW: Checkout -->
        <section id="view-checkout" class="view">
            <div class="container" style="max-width: 600px; margin-top: 40px;">
                <button onclick="app.nav('cart')" style="color:#888; background:none; margin-bottom: 20px;">&larr; Back to Cart</button>
                <h2>Checkout</h2>
                <form id="checkout-form" onsubmit="event.preventDefault(); app.finalizeOrder()">
                    <h3>Shipping Details</h3>
                    <div class="grid" style="grid-template-columns: 1fr 1fr;">
                        <input class="input" id="ship-fname" placeholder="First Name" required>
                        <input class="input" id="ship-lname" placeholder="Last Name" required>
                    </div>
                    <input class="input" id="ship-address" placeholder="Shipping Address" required style="margin-top: 10px;">
                    
                    <h3 style="margin-top: 30px;">Payment Method</h3>
                    <div class="payment-options">
                        <label class="payment-card selected" onclick="app.setPayment('cash', this)">
                            <input type="radio" name="payment" value="cash" checked> 💵 Cash on Delivery
                        </label>
                        <label class="payment-card" onclick="app.setPayment('visa', this)">
                            <input type="radio" name="payment" value="visa"> 💳 Visa / Credit Card
                        </label>
                    </div>
                    
                    <div id="visa-details" class="hidden" style="background: #222; padding: 15px; border-radius: 8px; margin-top: 10px;">
                        <input class="input" id="pay-card" placeholder="Card Number (16 digits)" style="margin-bottom: 10px;">
                        <div class="grid" style="grid-template-columns: 1fr 1fr;">
                            <input class="input" id="pay-expiry" placeholder="MM/YY">
                            <input class="input" id="pay-cvv" placeholder="CVV (3 digits)">
                        </div>
                    </div>

                    <div style="margin-top: 30px; border-top: 1px solid #333; padding-top: 20px;">
                        <div class="flex" style="justify-content: space-between; font-size: 1.2rem; font-weight: bold;">
                            <span>Total to Pay:</span>
                            <span class="text-primary" id="checkout-final-total">$0.00</span>
                        </div>
                        <button type="submit" class="btn" style="width: 100%; margin-top: 20px;">Place Order</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- VIEW: Community -->
        <section id="view-community" class="view">
            <div style="margin-top: 30px; margin-bottom: 20px;">
                <h1>Community Vibes</h1>
                <p style="color: var(--text-muted);">See how our community wears KickVibe in the real world. #KickVibeStyle</p>
            </div>
            
            <div class="ugc-grid" id="ugc-container"></div>
        </section>

        <!-- VIEW: Account / Login -->
        <section id="view-account" class="view">
            <div id="account-content" style="margin-top: 40px;"></div>
        </section>
        
        <!-- VIEW: About -->
        <section id="view-about" class="view">
            <div style="max-width: 600px; margin: 40px auto; text-align: center;">
                <h1 style="margin-bottom: 20px;">About KickVibe</h1>
                <p style="color: var(--text-muted); line-height: 1.8;">
                    KickVibe is a digital footwear brand offering trendy, comfortable, and high-quality shoes specifically designed for young adults.
                </p>
            </div>
        </section>

    </main>

    <!-- HELP WIDGET -->
    <div class="help-widget">
        <div id="help-menu" class="help-menu hidden">
            <button onclick="app.showReturnPolicy()" class="help-item">↺ Shoes Return</button>
            <button onclick="app.showFAQ()" class="help-item">❓ FAQs</button>
            <button onclick="app.showFeedback()" class="help-item">📢 Give Feedback</button>
        </div>
        <button class="help-btn" onclick="app.toggleHelp()">HELP & SUPPORT</button>
    </div>

    <!-- MODAL OVERLAY -->
    <div id="modal-overlay" class="modal-overlay hidden" onclick="app.closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="app.closeModal()">✕</button>
            <div id="modal-body"></div>
        </div>
    </div>

    <!-- CONTACT WIDGET -->
    <div class="contact-widget">
        <div id="contact-menu" class="contact-menu hidden">
            <a href="https://wa.me/201065245832" target="_blank" class="contact-item"><span>💬</span> WhatsApp</a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=amrelshazley3@gmail.com" target="_blank" class="contact-item"><span>✉️</span> Email Us</a>
        </div>
        <button class="contact-fab" onclick="app.toggleContact()">💬</button>
    </div>

    <!-- TOAST CONTAINER -->
    <div id="toast-container" class="toast-container"></div>

    <script>
        // --- 1. DATA STORE (Enhanced with Specs) ---
        const db = [
            { id: 101, name: "Urban Flow X1", price: 89.00, cat: "Street", color: "#ccff00", desc: "Designed for the city dweller.", specs: { material: "Breathable Mesh", weight: "280g", cushioning: "Medium", use: "Daily Wear" } },
            { id: 102, name: "Night Runner", price: 120.00, cat: "Sport", color: "#00f0ff", desc: "Reflective materials for night runs.", specs: { material: "Reflective Knit", weight: "240g", cushioning: "High (Foam)", use: "Running" } },
            { id: 103, name: "Canvas Classic", price: 55.00, cat: "Casual", color: "#ff4444", desc: "Timeless design, modern comfort.", specs: { material: "Canvas", weight: "320g", cushioning: "Low", use: "Casual" } },
            { id: 104, name: "Stealth High", price: 110.00, cat: "High-Top", color: "#333333", desc: "Ankle support with a minimalist look.", specs: { material: "Leather/Suede", weight: "410g", cushioning: "Medium", use: "Lifestyle" } },
            { id: 105, name: "Aero Glide", price: 145.00, cat: "Sport", color: "#ffffff", desc: "Air-cushioned sole technology.", specs: { material: "Performance Mesh", weight: "260g", cushioning: "Max Air", use: "Sports" } },
            { id: 106, name: "Retro Wave", price: 75.00, cat: "Casual", color: "#ff00cc", desc: "80s inspired aesthetics.", specs: { material: "Synthetic Leather", weight: "350g", cushioning: "Low", use: "Vintage Style" } }
        ];

        const ugcVideos = [
            { id: 1, user: "@skater_boi", desc: "Testing the Urban Flow X1 at the park! 🛹", color: "#ccff00" },
            { id: 2, user: "@sarah_runs", desc: "Night Runner keeps me visible. Love it.", color: "#00f0ff" },
            { id: 3, user: "@city_walker", desc: "Unboxing the Stealth Highs. Quality is insane.", color: "#333333" },
            { id: 4, user: "@fashion_killa", desc: "Matching my outfit with the Retro Waves.", color: "#ff00cc" },
            { id: 5, user: "@gym_rat", desc: "Leg day in the Aero Glides. Stable base.", color: "#ffffff" }
        ];

        // --- 2. APPLICATION LOGIC ---
        const app = {
            state: {
                cart: JSON.parse(localStorage.getItem('kv_cart')) || [],
                compare: JSON.parse(localStorage.getItem('kv_compare')) || [],
                orders: JSON.parse(localStorage.getItem('kv_orders')) || [], // Added Orders
                user: JSON.parse(localStorage.getItem('kv_user')) || null,
                authMode: 'login',
                paymentMode: 'cash'
            },

            usersDB: JSON.parse(localStorage.getItem('kv_users_db')) || [
                { email: "demo@kickvibe.com", password: "password123", name: "Demo User", phone: "1234567890", address: "123 Urban St" }
            ],

            init: () => {
                app.updateOrderTracking();
                app.renderShop();
                app.renderCommunity();
                app.updateUI();
            },

            nav: (viewId) => {
                document.querySelectorAll('.view').forEach(el => el.classList.remove('active'));
                
                if (viewId === 'account') app.renderAccount();
                if (viewId === 'compare') app.renderCompare();
                
                document.getElementById(`view-${viewId}`).classList.add('active');
                window.scrollTo(0,0);
            },

            // --- ORDER TRACKING SIMULATION ---
            updateOrderTracking: () => {
                const now = Date.now();
                let updated = false;
                app.state.orders.forEach(order => {
                    // Ensure timestamp exists (for legacy support in localstorage)
                    if(!order.timestamp) {
                        order.timestamp = now; // If missing, start tracking from now
                        updated = true;
                    }

                    const msPerDay = 24 * 60 * 60 * 1000;
                    const elapsed = now - order.timestamp;
                    const stepsAdvanced = Math.floor(elapsed / msPerDay);
                    
                    const newStep = Math.min(stepsAdvanced, 3); // Max step 3 (Delivered)
                    
                    if(order.statusStep !== newStep) {
                        order.statusStep = newStep;
                        updated = true;
                    }
                });

                if(updated) {
                    app.saveOrders();
                }
            },

            saveOrders: () => {
                localStorage.setItem('kv_orders', JSON.stringify(app.state.orders));
            },

            renderTracking: (step) => {
                // 0: Processing, 1: Shipped, 2: Out for Delivery, 3: Delivered
                const width = (step / 3) * 100;
                return `
                    <div class="track-container">
                        <div class="track-line-bg"></div>
                        <div class="track-line-fill" style="width: ${width}%"></div>
                        
                        <div class="track-step ${step >= 0 ? 'active' : ''}">
                            <div class="track-circle">🏭</div>
                            <div class="track-label">Processing</div>
                        </div>
                        <div class="track-step ${step >= 1 ? 'active' : ''}">
                            <div class="track-circle">🚚</div>
                            <div class="track-label">Shipped</div>
                        </div>
                        <div class="track-step ${step >= 2 ? 'active' : ''}">
                            <div class="track-circle">📦</div>
                            <div class="track-label">En Route</div>
                        </div>
                        <div class="track-step ${step >= 3 ? 'active' : ''}">
                            <div class="track-circle">🏠</div>
                            <div class="track-label">Delivered</div>
                        </div>
                    </div>
                `;
            },

            // --- ACCOUNT LOGIC ---
            renderAccount: () => {
                const container = document.getElementById('account-content');
                if (app.state.user) {
                    const ordersHtml = app.state.orders.length === 0 
                        ? `<div style="background:var(--surface-dark); padding:30px; border-radius:8px; text-align:center; margin-top:15px; border:1px dashed #333;">
                                <p style="color:var(--text-muted)">No active orders.</p>
                                <button class="btn" style="margin-top:10px;" onclick="app.nav('shop')">Start Shopping</button>
                           </div>`
                        : app.state.orders.slice().reverse().map(order => `
                            <div class="order-card">
                                <div class="flex" style="justify-content:space-between; border-bottom:1px solid #333; padding-bottom:10px; margin-bottom:15px;">
                                    <div>
                                        <b style="color:var(--brand-primary)">Order #${order.id}</b>
                                        <div style="font-size:0.8rem; color:#888;">${order.date}</div>
                                    </div>
                                    <div style="text-align:right;">
                                        <b>${order.total}</b>
                                        <div style="font-size:0.8rem;">${order.items} Items</div>
                                    </div>
                                </div>
                                ${app.renderTracking(order.statusStep)}
                            </div>
                        `).join('');

                    container.innerHTML = `
                        <div class="container">
                            <div class="profile-header">
                                <div class="flex">
                                    <div class="avatar">${app.state.user.name.charAt(0)}</div>
                                    <div>
                                        <h2 style="margin:0">${app.state.user.name}</h2>
                                        <p style="color:var(--text-muted)">${app.state.user.email}</p>
                                        <p style="font-size:0.9rem; color:#666;">${app.state.user.phone || ''} • ${app.state.user.address || ''}</p>
                                    </div>
                                </div>
                                <button class="btn-outline" onclick="app.logout()">Logout</button>
                            </div>
                            <h3>Your Orders</h3>
                            ${ordersHtml}
                        </div>
                    `;
                } else {
                    const isLogin = app.state.authMode === 'login';
                    container.innerHTML = `
                        <div class="auth-container">
                            <div class="auth-card">
                                <h2 class="text-center">${isLogin ? 'Welcome Back' : 'Join KickVibe'}</h2>
                                <form class="auth-form" onsubmit="event.preventDefault(); ${isLogin ? 'app.handleLogin()' : 'app.handleRegister()'}">
                                    ${!isLogin ? `
                                        <input type="text" id="auth-name" class="input" placeholder="Full Name" required>
                                        <input type="tel" id="auth-phone" class="input" placeholder="Phone Number" required>
                                        <input type="text" id="auth-address" class="input" placeholder="Default Address" required>
                                    ` : ''}
                                    <input type="email" id="auth-email" class="input" placeholder="Email Address" required>
                                    <input type="password" id="auth-pass" class="input" placeholder="Password" required>
                                    <button type="submit" class="btn" style="width:100%">${isLogin ? 'Log In' : 'Sign Up'}</button>
                                </form>
                                <div class="auth-switch">
                                    ${isLogin ? "Don't have an account?" : "Already have an account?"} <span onclick="app.toggleAuthMode()">${isLogin ? 'Sign Up' : 'Log In'}</span>
                                </div>
                                ${isLogin ? `<div style="margin-top:15px; font-size:0.8rem; color:#666; text-align:center;">Demo: demo@kickvibe.com / password123</div>` : ''}
                            </div>
                        </div>
                    `;
                }
            },
            toggleAuthMode: () => { app.state.authMode = app.state.authMode === 'login' ? 'register' : 'login'; app.renderAccount(); },
            handleLogin: () => {
                const email = document.getElementById('auth-email').value;
                const pass = document.getElementById('auth-pass').value;
                const user = app.usersDB.find(u => u.email === email && u.password === pass);
                if (user) { app.state.user = user; app.saveUser(); app.nav('account'); app.updateUI(); } else { app.showToast("Invalid email or password!", true); }
            },
            handleRegister: () => {
                try {
                    const name = document.getElementById('auth-name').value;
                    const email = document.getElementById('auth-email').value;
                    const pass = document.getElementById('auth-pass').value;
                    const phone = document.getElementById('auth-phone').value;
                    const address = document.getElementById('auth-address').value;
                    if (/\d/.test(name)) throw new Error("Name cannot contain numbers!");
                    if (/[^0-9]/.test(phone)) throw new Error("Phone number must contain only digits!");
                    if (app.usersDB.find(u => u.email === email)) throw new Error("Account already exists.");
                    const newUser = { email, password: pass, name, phone, address };
                    app.usersDB.push(newUser);
                    localStorage.setItem('kv_users_db', JSON.stringify(app.usersDB));
                    app.state.user = newUser; app.saveUser(); app.nav('account'); app.updateUI(); app.showToast("Account created!");
                } catch (error) { app.showToast(error.message, true); }
            },
            logout: () => { app.state.user = null; localStorage.removeItem('kv_user'); app.state.authMode = 'login'; app.nav('account'); app.updateUI(); },
            saveUser: () => { localStorage.setItem('kv_user', JSON.stringify(app.state.user)); },

            // --- CHECKOUT LOGIC ---
            initCheckout: () => {
                if(app.state.cart.length === 0) { 
                    app.showToast("Cart is empty!", true); 
                    return; 
                }

                // FORCE LOGIN CHECK
                if (!app.state.user) {
                    app.showToast("Please log in or sign up to checkout.", true);
                    app.nav('account'); // Redirect to login page
                    return;
                }

                const total = app.state.cart.reduce((sum, item) => sum + item.price, 0);
                document.getElementById('checkout-final-total').innerText = "$" + total.toFixed(2);
                
                // Pre-fill data (User is guaranteed to exist here)
                const names = app.state.user.name.split(' ');
                document.getElementById('ship-fname').value = names[0] || '';
                document.getElementById('ship-lname').value = names.slice(1).join(' ') || '';
                document.getElementById('ship-address').value = app.state.user.address || '';
                
                app.nav('checkout');
            },
            setPayment: (type, el) => {
                app.state.paymentMode = type;
                document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('selected'));
                el.classList.add('selected');
                el.querySelector('input').checked = true;
                const details = document.getElementById('visa-details');
                if (type === 'visa') {
                    details.classList.remove('hidden');
                    details.querySelectorAll('input').forEach(i => i.required = true);
                } else {
                    details.classList.add('hidden');
                    details.querySelectorAll('input').forEach(i => i.required = false);
                }
            },
            finalizeOrder: () => {
                try {
                    const fname = document.getElementById('ship-fname').value;
                    const lname = document.getElementById('ship-lname').value;
                    if (/\d/.test(fname) || /\d/.test(lname)) throw new Error("Names cannot contain numbers!");
                    if (app.state.paymentMode === 'visa') {
                        const cardNum = document.getElementById('pay-card').value;
                        const cvv = document.getElementById('pay-cvv').value;
                        if (!/^\d{16}$/.test(cardNum.replace(/\s/g, ''))) throw new Error("Invalid Visa Card Number!");
                        if (!/^\d{3,4}$/.test(cvv)) throw new Error("Invalid CVV!");
                    }
                    const btn = document.querySelector('#checkout-form button[type="submit"]');
                    const originalText = btn.innerText;
                    btn.innerText = "Processing..."; btn.style.opacity = "0.7"; btn.disabled = true;
                    
                    // SAVE ORDER LOGIC
                    setTimeout(() => {
                        const newOrder = {
                            id: Math.floor(Math.random() * 10000),
                            date: new Date().toLocaleDateString(),
                            timestamp: Date.now(), // Added for tracking
                            items: app.state.cart.length,
                            total: document.getElementById('checkout-final-total').innerText,
                            statusStep: 0 // 0: Factory, 1: Shipped, 2: Route, 3: Delivered
                        };
                        
                        app.state.orders.push(newOrder);
                        app.saveOrders(); // Save to local storage
                        
                        app.state.cart = []; 
                        app.saveCart(); 
                        app.updateUI(); 
                        app.showToast("Order Placed Successfully!"); 
                        
                        // If logged in, go to account tracking, else home
                        if(app.state.user) {
                            app.nav('account');
                        } else {
                            app.nav('home');
                        }
                        
                        btn.innerText = originalText; btn.style.opacity = "1"; btn.disabled = false;
                    }, 2000); 
                } catch (error) { app.showToast(error.message, true); }
            },

            // --- CORE FUNCTIONS ---
            renderShop: (filter = "") => {
                const createCard = (p) => {
                    const inCompare = app.state.compare.includes(p.id);
                    return `
                    <div class="product-card">
                        <div class="card-img-box">
                            <div class="shoe-sprite" style="background: linear-gradient(135deg, #444, ${p.color})"></div>
                        </div>
                        <div class="card-details">
                            <div class="card-cat">${p.cat}</div>
                            <div class="card-title">${p.name}</div>
                            <div class="flex" style="gap:5px; margin-bottom:5px;">
                                <div class="feature-tag"><b>Material</b>${p.specs.material}</div>
                            </div>
                            <div class="card-footer">
                                <span>$${p.price}</span>
                                <div style="display:flex; gap:5px;">
                                    <button class="btn-icon ${inCompare?'active':''}" style="width:30px; height:30px; font-size:12px;" onclick="app.toggleCompare(${p.id})">⚖️</button>
                                    <button class="btn-icon" style="width:30px; height:30px; font-size:12px;" onclick="app.loadDetail(${p.id})">👁</button>
                                    <button class="btn-icon" style="width:30px; height:30px; font-size:12px;" onclick="app.addToCart(${p.id})">+</button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                };
                const filtered = db.filter(p => p.name.toLowerCase().includes(filter.toLowerCase()));
                document.getElementById('shop-grid').innerHTML = filtered.map(createCard).join('');
                document.getElementById('featured-grid').innerHTML = filtered.slice(0,3).map(createCard).join('');
            },

            toggleCompare: (id) => {
                const index = app.state.compare.indexOf(id);
                if (index > -1) { app.state.compare.splice(index, 1); app.showToast("Removed from comparison."); } 
                else { if (app.state.compare.length >= 2) { app.showToast("Comparison full!", true); return; } app.state.compare.push(id); app.showToast("Added to comparison!"); }
                localStorage.setItem('kv_compare', JSON.stringify(app.state.compare)); app.updateUI();
                const detailContent = document.getElementById('detail-content'); if(detailContent.innerHTML !== "") app.loadDetail(id);
            },

            renderCompare: () => {
                const container = document.getElementById('compare-content');
                const ids = app.state.compare;
                if (ids.length === 0) { container.innerHTML = `<p>No items selected. Go to shop and add items to compare.</p><button class="btn" onclick="app.nav('shop')">Go to Shop</button>`; return; }
                const p1 = db.find(x => x.id === ids[0]);
                const p2 = ids.length > 1 ? db.find(x => x.id === ids[1]) : null;
                let html = `
                    <div class="compare-grid">
                        <div class="compare-header">Feature</div>
                        <div class="compare-header">${p1.name} <br> <button class="btn-icon" style="width:24px;height:24px;margin:5px auto;" onclick="app.toggleCompare(${p1.id}); app.renderCompare()">✕</button></div>
                        <div class="compare-header">${p2 ? p2.name : 'Empty Slot'} ${p2 ? `<br> <button class="btn-icon" style="width:24px;height:24px;margin:5px auto;" onclick="app.toggleCompare(${p2.id}); app.renderCompare()">✕</button>` : ''}</div>
                        <div class="compare-cell" style="text-align:left; font-weight:bold;">Image</div>
                        <div class="compare-cell"><div class="shoe-sprite" style="width:100px; height:50px; margin:0 auto; background: linear-gradient(135deg, #444, ${p1.color})"></div></div>
                        <div class="compare-cell">${p2 ? `<div class="shoe-sprite" style="width:100px; height:50px; margin:0 auto; background: linear-gradient(135deg, #444, ${p2.color})"></div>` : '-'}</div>
                        <div class="compare-cell" style="text-align:left; font-weight:bold;">Price</div>
                        <div class="compare-cell text-primary">$${p1.price}</div>
                        <div class="compare-cell text-primary">${p2 ? '$'+p2.price : '-'}</div>
                        <div class="compare-cell" style="text-align:left; font-weight:bold;">Material</div>
                        <div class="compare-cell">${p1.specs.material}</div>
                        <div class="compare-cell">${p2 ? p2.specs.material : '-'}</div>
                        <div class="compare-cell" style="text-align:left; font-weight:bold;">Weight</div>
                        <div class="compare-cell">${p1.specs.weight}</div>
                        <div class="compare-cell">${p2 ? p2.specs.weight : '-'}</div>
                        <div class="compare-cell" style="text-align:left; font-weight:bold;">Cushioning</div>
                        <div class="compare-cell">${p1.specs.cushioning}</div>
                        <div class="compare-cell">${p2 ? p2.specs.cushioning : '-'}</div>
                        <div class="compare-cell" style="text-align:left; font-weight:bold;">Best For</div>
                        <div class="compare-cell">${p1.specs.use}</div>
                        <div class="compare-cell">${p2 ? p2.specs.use : '-'}</div>
                        <div class="compare-cell"></div>
                        <div class="compare-cell"><button class="btn" onclick="app.addToCart(${p1.id})">Add to Cart</button></div>
                        <div class="compare-cell">${p2 ? `<button class="btn" onclick="app.addToCart(${p2.id})">Add to Cart</button>` : ''}</div>
                    </div>
                `;
                container.innerHTML = html;
            },

            renderCommunity: () => {
                const html = ugcVideos.map(vid => `
                    <div class="video-card" onclick="alert('Video playback modal would open here.')">
                        <div class="video-thumb" style="background: linear-gradient(45deg, #333, ${vid.color}); height:100%;"></div>
                        <div class="play-btn-overlay">▶</div>
                        <div class="video-info">
                            <div class="user-tag">${vid.user}</div>
                            <div class="video-desc">${vid.desc}</div>
                        </div>
                    </div>
                `).join('');
                document.getElementById('ugc-container').innerHTML = html;
            },

            loadDetail: (id) => {
                const p = db.find(x => x.id === id);
                const inCompare = app.state.compare.includes(p.id);
                const html = `
                    <div class="detail-layout">
                        <div class="preview-container scene-studio" id="preview-stage">
                            <div class="shoe-large" style="background: linear-gradient(135deg, #444, ${p.color})"></div>
                            <div class="controls-bar">
                                <button class="btn-icon" onclick="app.setScene('studio')">📷</button>
                                <button class="btn-icon" onclick="app.setScene('street')">🏙</button>
                                <button class="btn-icon" onclick="app.setScene('night')">🌙</button>
                                <div style="width:1px; background:#555; height:20px; margin: auto 5px;"></div>
                                <button class="btn-icon" onclick="app.toggleMotion(this)">🏃</button>
                            </div>
                        </div>
                        <div>
                            <span class="text-primary" style="font-weight:bold; letter-spacing:1px; text-transform:uppercase;">${p.cat}</span>
                            <h1 style="font-size:3rem; line-height:1.1; margin:10px 0;">${p.name}</h1>
                            <h2 style="margin-bottom:20px;">$${p.price.toFixed(2)}</h2>
                            <p style="color:var(--text-muted); margin-bottom:20px;">${p.desc}</p>
                            
                            <h3 style="margin-bottom:10px;">Specifications</h3>
                            <div class="grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 20px;">
                                <div class="feature-tag"><b>Material</b>${p.specs.material}</div>
                                <div class="feature-tag"><b>Weight</b>${p.specs.weight}</div>
                                <div class="feature-tag"><b>Cushioning</b>${p.specs.cushioning}</div>
                                <div class="feature-tag"><b>Best For</b>${p.specs.use}</div>
                            </div>

                            <div class="flex" style="gap:10px;">
                                <button class="btn" style="flex:1" onclick="app.addToCart(${p.id})">Add to Cart</button>
                                <button class="btn-outline ${inCompare?'active':''}" onclick="app.toggleCompare(${p.id})">
                                    ${inCompare ? 'Remove Comparison' : 'Add to Compare'}
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('detail-content').innerHTML = html;
                app.nav('detail');
            },

            setScene: (mode) => { document.getElementById('preview-stage').className = `preview-container scene-${mode}`; },
            toggleMotion: (btn) => {
                const stage = document.getElementById('preview-stage');
                const isActive = stage.classList.contains('motion-active');
                if (isActive) { stage.classList.remove('motion-active'); btn.style.background = ''; btn.style.color = ''; } 
                else { stage.classList.add('motion-active'); btn.style.background = 'var(--brand-primary)'; btn.style.color = 'black'; }
            },
            addToCart: (id) => { const p = db.find(x => x.id === id); app.state.cart.push(p); app.saveCart(); app.showToast(`${p.name} added to cart!`); app.updateUI(); },
            showToast: (msg, isError = false) => {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = `toast ${isError ? 'error' : ''}`;
                toast.innerHTML = `<span>${isError ? '⚠️' : '✅'}</span> ${msg}`;
                container.appendChild(toast);
                setTimeout(() => { toast.style.opacity = '0'; toast.style.transform = 'translateY(20px)'; setTimeout(() => toast.remove(), 300); }, 3000);
            },
            renderCart: () => {
                const list = document.getElementById('cart-list');
                let total = 0;
                if(app.state.cart.length === 0) { list.innerHTML = "<p>Cart is empty.</p>"; document.getElementById('cart-total').innerText = "$0.00"; return; }
                list.innerHTML = app.state.cart.map((item, idx) => {
                    total += item.price;
                    return `
                    <div style="background:var(--surface-dark); padding:15px; border-radius:4px; display:flex; justify-content:space-between; align-items:center;">
                        <div class="flex" style="gap:15px;">
                            <div style="width:40px; height:40px; background:${item.color}; border-radius:4px;"></div>
                            <div><b>${item.name}</b><br><small class="text-primary">$${item.price}</small></div>
                        </div>
                        <button style="color:#ff4444; background:none;" onclick="app.removeCart(${idx})">✕</button>
                    </div>`;
                }).join('');
                document.getElementById('cart-total').innerText = "$" + total.toFixed(2);
            },
            removeCart: (idx) => { app.state.cart.splice(idx, 1); app.saveCart(); app.updateUI(); },
            saveCart: () => { localStorage.setItem('kv_cart', JSON.stringify(app.state.cart)); },
            updateUI: () => {
                const badge = document.getElementById('badge-cart');
                if (badge) { badge.innerText = app.state.cart.length; badge.classList.toggle('hidden', app.state.cart.length === 0); }
                const compBadge = document.getElementById('badge-compare');
                if (compBadge) { compBadge.innerText = `(${app.state.compare.length})`; compBadge.classList.toggle('hidden', app.state.compare.length === 0); }
                app.renderCart();
                const navLink = document.getElementById('nav-account-link');
                if (navLink) {
                    if (app.state.user) { navLink.innerText = app.state.user.name.split(' ')[0]; navLink.classList.add('text-primary'); } 
                    else { navLink.innerText = 'Login'; navLink.classList.remove('text-primary'); }
                }
            },
            filter: (val) => app.renderShop(val),

            toggleContact: () => { document.getElementById('contact-menu').classList.toggle('hidden'); },

            // --- HELP & SUPPORT LOGIC ---
            toggleHelp: () => {
                const menu = document.getElementById('help-menu');
                menu.classList.toggle('hidden');
            },

            showModal: (content) => {
                const overlay = document.getElementById('modal-overlay');
                const body = document.getElementById('modal-body');
                body.innerHTML = content;
                overlay.classList.remove('hidden');
                document.getElementById('help-menu').classList.add('hidden'); // Close menu
            },

            closeModal: () => {
                document.getElementById('modal-overlay').classList.add('hidden');
            },

            showReturnPolicy: () => {
                app.showModal(`
                    <h2 style="margin-bottom:20px;">↺ Returns & Exchanges</h2>
                    <p style="color:#ccc; line-height:1.6; margin-bottom:15px;">
                        We want you to love your KickVibe shoes! If you aren't 100% satisfied, you can return them within <strong>30 days</strong> of purchase.
                    </p>
                    <ul style="margin:15px 0 25px 20px; color:#ccc; line-height:1.8;">
                        <li>Items must be unworn and in original box.</li>
                        <li>Refunds are processed to original payment method.</li>
                        <li>Return shipping is free for registered members.</li>
                    </ul>
                    <button class="btn" style="width:100%" onclick="app.closeModal()">Got it</button>
                `);
            },

            showFAQ: () => {
                app.showModal(`
                    <h2 style="margin-bottom:20px;">❓ Frequently Asked Questions</h2>
                    <div style="display:flex; flex-direction:column; gap:20px;">
                        <div>
                            <h4 style="color:var(--brand-primary); margin-bottom:5px;">How long does shipping take?</h4>
                            <p style="font-size:0.9rem; color:#ccc">Standard shipping usually takes 3-5 business days. Order tracking is available in your account.</p>
                        </div>
                        <div>
                            <h4 style="color:var(--brand-primary); margin-bottom:5px;">Do you ship internationally?</h4>
                            <p style="font-size:0.9rem; color:#ccc">Yes! We ship to over 50 countries worldwide. Shipping rates apply.</p>
                        </div>
                        <div>
                            <h4 style="color:var(--brand-primary); margin-bottom:5px;">How do I clean my shoes?</h4>
                            <p style="font-size:0.9rem; color:#ccc">We recommend using a soft brush and mild soap. Avoid washing machines for best durability.</p>
                        </div>
                    </div>
                `);
            },

            showFeedback: () => {
                app.showModal(`
                    <h2 style="margin-bottom:10px;">📢 We Value Your Feedback</h2>
                    <p style="color:#ccc; margin-bottom:20px; font-size:0.9rem;">Tell us what you think about KickVibe. We read every message!</p>
                    <textarea id="feedback-text" class="input" style="height:120px; resize:none; margin-bottom:15px;" placeholder="Your thoughts..."></textarea>
                    <button class="btn" style="width:100%;" onclick="app.submitFeedback()">Submit Feedback</button>
                `);
            },

            submitFeedback: () => {
                const text = document.getElementById('feedback-text').value;
                if(!text.trim()) {
                    app.showToast("Please write something!", true);
                    return;
                }
                app.closeModal();
                app.showToast("Thank you for your feedback! ❤️");
            }
        };

        app.init();
    </script>
</body>
</html>

</body>
</html>
