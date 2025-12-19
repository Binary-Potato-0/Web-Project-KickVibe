// --- 1. DATA STORE ---
// (Original code remains exactly as you sent)

const db = [
    { id: 101, name: "Urban Flow X1", price: 89.00, cat: "Street", color: "#ccff00", desc: "Designed for the city dweller." },
    { id: 102, name: "Night Runner", price: 120.00, cat: "Sport", color: "#00f0ff", desc: "Reflective materials for night runs." },
    { id: 103, name: "Canvas Classic", price: 55.00, cat: "Casual", color: "#ff4444", desc: "Timeless design, modern comfort." },
    { id: 104, name: "Stealth High", price: 110.00, cat: "High-Top", color: "#333333", desc: "Ankle support with a minimalist look." },
    { id: 105, name: "Aero Glide", price: 145.00, cat: "Sport", color: "#ffffff", desc: "Air-cushioned sole technology." },
    { id: 106, name: "Retro Wave", price: 75.00, cat: "Casual", color: "#ff00cc", desc: "80s inspired aesthetics." }
];

const ugcVideos = [
    { id: 1, user: "@skater_boi", desc: "Testing the Urban Flow X1 at the park! 🛹", color: "#ccff00" },
    { id: 2, user: "@sarah_runs", desc: "Night Runner keeps me visible. Love it.", color: "#00f0ff" },
    { id: 3, user: "@city_walker", desc: "Unboxing the Stealth Highs. Quality is insane.", color: "#333333" },
    { id: 4, user: "@fashion_killa", desc: "Matching my outfit with the Retro Waves.", color: "#ff00cc" },
    { id: 5, user: "@gym_rat", desc: "Leg day in the Aero Glides. Stable base.", color: "#ffffff" }
];

// --- 2. APPLICATION LOGIC ---
// (Original code remains exactly as you sent)

const app = {
    state: {
        cart: JSON.parse(localStorage.getItem('kv_cart')) || [],
    },

    init: () => {
        app.renderShop();
        app.renderCommunity();
        app.updateUI();
        app.attachEvents();
        app.loadProductsFromServer(); // Added AJAX fetch
    },

    attachEvents: () => {
        document.querySelector('.logo').addEventListener('click', (e) => { e.preventDefault(); app.nav('home'); });
        document.getElementById('nav-cart-btn').addEventListener('click', () => app.nav('cart'));
        document.getElementById('hero-explore-btn').addEventListener('click', () => app.nav('shop'));

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                app.nav(link.getAttribute('data-view'));
            });
        });

        document.getElementById('shop-grid').addEventListener('click', app.handleCardActions);
        document.getElementById('featured-grid').addEventListener('click', app.handleCardActions);

        document.getElementById('shop-search-input').addEventListener('input', function() {
            app.filter(this.value);
        });

        document.getElementById('checkout-btn').addEventListener('click', () => {
            alert('Checkout integration pending payment gateway.');
        });

        document.getElementById('contact-fab-btn').addEventListener('click', app.toggleContact);

        document.getElementById('ugc-container').addEventListener('click', (e) => {
            if (e.target.closest('.video-card')) {
                alert('Video playback modal would open here.');
            }
        });
    },

    handleCardActions: (e) => {
        const target = e.target.closest('button');
        if (!target) return;

        const id = parseInt(target.getAttribute('data-id'));

        if (target.classList.contains('btn-view-detail')) {
            app.loadDetail(id);
        } else if (target.classList.contains('btn-add-cart')) {
            app.addToCart(id);
        }
    },

    nav: (viewId) => {
        document.querySelectorAll('.view').forEach(el => el.classList.remove('active'));
        document.getElementById(`view-${viewId}`).classList.add('active');

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
            if(link.getAttribute('data-view') === viewId) link.classList.add('active');
        });

        window.scrollTo(0,0);

        if (viewId === 'cart') app.renderCart();
    },

    renderShop: (filter = "") => {
        const createCard = (p) => `
            <div class="product-card">
                <div class="card-img-box">
                    <div class="shoe-sprite" style="background: linear-gradient(135deg, #444, ${p.color})"></div>
                </div>
                <div class="card-details">
                    <div class="card-cat">${p.cat}</div>
                    <div class="card-title">${p.name}</div>
                    <div class="card-footer">
                        <span>$${p.price}</span>
                        <div style="display:flex; gap:5px;">
                            <button class="btn-icon btn-view-detail" data-id="${p.id}" style="width:30px; height:30px; font-size:12px;">👁</button>
                            <button class="btn-icon btn-add-cart" data-id="${p.id}" style="width:30px; height:30px; font-size:12px;">+</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        const filtered = db.filter(p => p.name.toLowerCase().includes(filter.toLowerCase()));
        document.getElementById('shop-grid').innerHTML = filtered.map(createCard).join('');
        document.getElementById('featured-grid').innerHTML = filtered.slice(0,3).map(createCard).join('');
    },

    renderCommunity: () => {
        const html = ugcVideos.map(vid => `
            <div class="video-card">
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
        const html = `
            <div class="detail-layout">
                <div class="preview-container scene-studio" id="preview-stage">
                    <div class="shoe-large" style="background: linear-gradient(135deg, #444, ${p.color})"></div>
                    
                    <div class="controls-bar">
                        <button class="btn-icon scene-studio-btn" data-scene="studio" title="Studio">📷</button>
                        <button class="btn-icon scene-street-btn" data-scene="street" title="Street">🏙</button>
                        <button class="btn-icon scene-night-btn" data-scene="night" title="Night Life">🌙</button>
                        <div style="width:1px; background:#555; height:20px; margin: auto 5px;"></div>
                        <button class="btn-icon toggle-motion-btn" title="Toggle Motion">🏃</button>
                    </div>
                </div>

                <div>
                    <span class="text-primary" style="font-weight:bold; letter-spacing:1px; text-transform:uppercase;">${p.cat}</span>
                    <h1 style="font-size:3rem; line-height:1.1; margin:10px 0;">${p.name}</h1>
                    <h2 style="margin-bottom:20px;">$${p.price.toFixed(2)}</h2>
                    <p style="color:var(--text-muted); margin-bottom:30px;">${p.desc} <br> Crafted for maximum durability and style. This shoe features our patented comfort sole.</p>
                    
                    <div style="background:#222; padding:15px; border-radius:4px; margin-bottom:30px; display:flex; gap:10px; align-items:center;">
                        <span>📏</span>
                        <small style="color:var(--text-muted)"><strong>Fit Guide:</strong> Runs true to size. Most users order their usual size.</small>
                    </div>

                    <div class="flex" style="gap:10px;">
                        <button class="btn add-to-cart-detail-btn" data-id="${p.id}" style="flex:1">Add to Cart</button>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('detail-content').innerHTML = html;
        app.nav('detail');

        document.getElementById('back-to-shop-btn').addEventListener('click', () => app.nav('shop'));

        document.querySelectorAll('.controls-bar button[data-scene]').forEach(btn => {
            btn.addEventListener('click', function() {
                app.setScene(this.getAttribute('data-scene'));
            });
        });

        document.querySelector('.toggle-motion-btn').addEventListener('click', function() {
            app.toggleMotion(this);
        });

        document.querySelector('.add-to-cart-detail-btn').addEventListener('click', function() {
            app.addToCart(parseInt(this.getAttribute('data-id')));
        });
    },

    setScene: (mode) => {
        const stage = document.getElementById('preview-stage');
        stage.classList.remove('scene-studio', 'scene-street', 'scene-night');
        stage.classList.add(`scene-${mode}`);
    },

    toggleMotion: (btn) => {
        const stage = document.getElementById('preview-stage');
        const isActive = stage.classList.toggle('motion-active');
        if (isActive) {
            btn.style.background = 'var(--brand-primary)';
            btn.style.color = 'black';
        } else {
            btn.style.background = '';
            btn.style.color = '';
        }
    },

    addToCart: (id) => {
        const p = db.find(x => x.id === id);
        app.state.cart.push(p);
        app.save();
        alert(`${p.name} added to cart!`);
    },

    renderCart: () => {
        const list = document.getElementById('cart-list');
        let total = 0;
        if(app.state.cart.length === 0) {
            list.innerHTML = "<p>Cart is empty.</p>";
            document.getElementById('cart-total').innerText = "$0.00";
            return;
        }
        list.innerHTML = app.state.cart.map((item, idx) => {
            total += item.price;
            return `
            <div style="background:var(--surface-dark); padding:15px; border-radius:4px; display:flex; justify-content:space-between; align-items:center;">
                <div class="flex" style="gap:15px;">
                    <div style="width:40px; height:40px; background:${item.color}; border-radius:4px;"></div>
                    <div>
                        <b>${item.name}</b><br>
                        <small class="text-primary">$${item.price}</small>
                    </div>
                </div>
                <button class="btn-remove-cart" data-index="${idx}" style="color:#ff4444; background:none;">✕</button>
            </div>`;
        }).join('');

        document.getElementById('cart-total').innerText = "$" + total.toFixed(2);

        document.querySelectorAll('.btn-remove-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                app.removeCart(parseInt(this.getAttribute('data-index')));
            });
        });
    },

    removeCart: (idx) => {
        app.state.cart.splice(idx, 1);
        app.save();
    },

    save: () => {
        localStorage.setItem('kv_cart', JSON.stringify(app.state.cart));
        app.updateUI();
    },

    updateUI: () => {
        document.getElementById('badge-cart').innerText = app.state.cart.length;
        document.getElementById('badge-cart').classList.toggle('hidden', app.state.cart.length === 0);
        if (document.getElementById('view-cart').classList.contains('active')) app.renderCart();
    },

    filter: (val) => app.renderShop(val),

    toggleContact: () => {
        const menu = document.getElementById('contact-menu');
        menu.classList.toggle('hidden');
    },

    // --- ADDED AJAX / JSON FETCH ---
    loadProductsFromServer: () => {
        // Using Fetch API
        fetch("../backend/products.php")
            .then(res => res.json())
            .then(data => {
                console.log("AJAX/JSON Products loaded from server:", data);
                // Optional: replace frontend `db` temporarily (if desired)
                // db = data;
            })
            .catch(err => console.error("Error loading products:", err));

        // Using jQuery (example usage)
        if (window.jQuery) {
            $.getJSON("../backend/products.php", function(data) {
                console.log("jQuery JSON products:", data);
            });
        }
    }
};

// Boot the application when DOM is fully loaded
document.addEventListener('DOMContentLoaded', app.init);
