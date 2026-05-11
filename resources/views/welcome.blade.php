<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartFood AI | Premium Food Processing</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|outfit:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fdfbf7; color: #2d2926; }
        h1, h2, h3, h4, h5, h6, .font-display { font-family: 'Outfit', sans-serif; }
        
        /* Premium Background Mesh */
        .gradient-mesh {
            position: absolute; top: 0; left: 0; width: 100vw; height: 100vh;
            background: radial-gradient(circle at 15% 50%, rgba(74, 222, 128, 0.08), transparent 25%),
                        radial-gradient(circle at 85% 30%, rgba(251, 146, 60, 0.08), transparent 25%);
            z-index: -1; pointer-events: none;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 40px -15px rgba(34, 197, 94, 0.08);
        }

        /* Magnetic Button Effect */
        .magnetic-btn { position: relative; overflow: hidden; }
        .magnetic-btn::after {
            content: ''; position: absolute; width: 100%; height: 100%;
            top: 0; left: 0; background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: translateX(-100%); transition: transform 0.6s ease;
        }
        .magnetic-btn:hover::after { transform: translateX(100%); }

        /* Typography Shimmer */
        .text-shimmer {
            background: linear-gradient(to right, #15803d 20%, #4ade80 40%, #4ade80 60%, #15803d 80%);
            background-size: 200% auto;
            color: #000;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer { to { background-position: 200% center; } }
        
        .gsap-reveal { opacity: 0; transform: translateY(30px); }
        .word-reveal span { display: inline-block; opacity: 0; transform: translateY(20px); }
    </style>
</head>
<body class="antialiased overflow-x-hidden selection:bg-leaf-200 selection:text-leaf-900" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <div class="gradient-mesh"></div>

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-leaf-300 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-float-slow"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-citrus-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-10 left-1/2 w-80 h-80 bg-leaf-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob" style="animation-delay: 4s;"></div>
    </div>

    <!-- Premium Navbar -->
    <nav :class="{ 'glass-nav shadow-sm py-4': scrolled, 'bg-transparent py-6': !scrolled }" class="fixed w-full z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-leaf-400 to-leaf-600 flex items-center justify-center text-white font-bold text-xl shadow-organic transition-transform duration-300 group-hover:scale-110">
                        SF
                    </div>
                    <span class="font-display font-bold text-2xl tracking-tight text-earth-900">SmartFood<span class="text-leaf-500">.ai</span></span>
                </div>
                <div class="hidden md:flex space-x-10">
                    <a href="#processing" class="text-sm font-semibold text-earth-800/70 hover:text-leaf-600 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-0.5 after:bg-leaf-500 hover:after:w-full after:transition-all after:duration-300">Flow</a>
                    <a href="#analytics" class="text-sm font-semibold text-earth-800/70 hover:text-leaf-600 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-0.5 after:bg-leaf-500 hover:after:w-full after:transition-all after:duration-300">AI Analytics</a>
                    <a href="#stats" class="text-sm font-semibold text-earth-800/70 hover:text-leaf-600 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-0.5 after:bg-leaf-500 hover:after:w-full after:transition-all after:duration-300">Impact</a>
                </div>
                <div class="flex items-center space-x-5">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="magnetic-btn px-6 py-3 rounded-2xl bg-leaf-500 hover:bg-leaf-600 text-white text-sm font-bold transition-all shadow-organic hover:-translate-y-1">Open Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-earth-900 hover:text-leaf-600 transition-colors">Sign In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="magnetic-btn px-6 py-3 rounded-2xl bg-earth-900 text-white hover:bg-earth-800 text-sm font-bold transition-all shadow-xl hover:-translate-y-1">Get Started</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 flex flex-col items-center text-center">
            
            <div class="hero-badge inline-flex items-center gap-2 px-5 py-2.5 rounded-full glass-card text-leaf-700 text-sm font-bold mb-8 opacity-0 translate-y-4">
                <span class="flex h-2.5 w-2.5 rounded-full bg-leaf-500 animate-pulse"></span>
                Food-Tech OS 2.0 is Live
            </div>

            <h1 class="text-6xl md:text-8xl font-display font-extrabold tracking-tight leading-[1.1] text-earth-900 max-w-5xl mx-auto mb-8">
                <span class="word-reveal">The Future of</span><br/>
                <span class="text-shimmer word-reveal">Food Processing.</span>
            </h1>
            
            <p class="hero-text text-xl md:text-2xl text-earth-800/60 max-w-3xl mx-auto mb-12 font-medium leading-relaxed opacity-0 translate-y-4">
                Revolutionize your supply chain with AI-driven quality control, real-time freshness tracking, and intelligent warehouse automation.
            </p>
            
            <div class="hero-ctas flex flex-col sm:flex-row gap-5 justify-center opacity-0 translate-y-4">
                <a href="{{ route('register') ?? '#' }}" class="magnetic-btn px-10 py-5 rounded-2xl bg-gradient-to-r from-leaf-500 to-leaf-600 text-white font-bold text-lg shadow-organic transition-all hover:shadow-[0_20px_40px_-10px_rgba(34,197,94,0.4)] flex items-center justify-center gap-3 group">
                    Access Platform
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#processing" class="magnetic-btn px-10 py-5 rounded-2xl glass-card text-earth-900 font-bold text-lg hover:bg-white/90 transition-all flex items-center justify-center gap-3 group">
                    Watch Demo
                    <div class="w-8 h-8 rounded-full bg-leaf-100 flex items-center justify-center text-leaf-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6V4z"></path></svg>
                    </div>
                </a>
            </div>

            <!-- Floating Dashboard Preview -->
            <div class="hero-image mt-24 relative w-full max-w-5xl mx-auto opacity-0 translate-y-10" style="perspective: 1200px;">
                <div class="relative transform rotate-x-[8deg] transition-transform duration-1000 hover:rotate-x-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-earth-50 via-transparent to-transparent z-10 bottom-0 h-1/2"></div>
                    <img src="{{ asset('images/dashboard_preview.png') }}" alt="Dashboard Preview" class="rounded-[2.5rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] border-4 border-white/50 relative z-0">
                    
                    <!-- Interactive Floating Elements -->
                    <div class="absolute -right-8 top-1/4 glass-card p-4 rounded-2xl flex items-center gap-4 z-20 animate-float-slow shadow-xl">
                        <div class="w-12 h-12 bg-citrus-100 rounded-xl flex items-center justify-center text-citrus-500 text-xl font-bold">🍅</div>
                        <div>
                            <p class="text-xs text-earth-800/60 font-bold uppercase">Freshness</p>
                            <p class="text-lg font-display font-bold text-earth-900">98.5%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Processing Flow Section -->
    <section id="processing" class="py-32 relative bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 gsap-reveal">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-leaf-50 text-leaf-700 text-xs font-bold uppercase tracking-widest mb-4">
                    Smart Pipeline
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-extrabold text-earth-900 mb-6">Intelligent Workflow</h2>
                <p class="text-xl text-earth-800/60 font-medium">From raw harvest to finalized packaging, our AI monitors every micro-step of the food processing lifecycle.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">
                <!-- Connecting Line -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-leaf-200 via-leaf-400 to-citrus-300 -translate-y-1/2 z-0 opacity-30"></div>

                <!-- Step 1 -->
                <div class="flow-step relative z-10 glass-card p-8 rounded-[2rem] hover:-translate-y-4 transition-all duration-500 group bg-white/80">
                    <div class="w-16 h-16 bg-leaf-100 rounded-2xl flex items-center justify-center text-leaf-600 mb-6 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-earth-900 mb-3">1. Intake</h3>
                    <p class="text-earth-800/60 font-medium text-sm leading-relaxed">Automated sorting and initial quality scanning using computer vision.</p>
                </div>

                <!-- Step 2 -->
                <div class="flow-step relative z-10 glass-card p-8 rounded-[2rem] hover:-translate-y-4 transition-all duration-500 group bg-white/80" style="transition-delay: 100ms;">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-earth-900 mb-3">2. Processing</h3>
                    <p class="text-earth-800/60 font-medium text-sm leading-relaxed">Temperature and humidity controlled environments optimized per batch.</p>
                </div>

                <!-- Step 3 -->
                <div class="flow-step relative z-10 glass-card p-8 rounded-[2rem] hover:-translate-y-4 transition-all duration-500 group bg-white/80" style="transition-delay: 200ms;">
                    <div class="w-16 h-16 bg-citrus-100 rounded-2xl flex items-center justify-center text-citrus-600 mb-6 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-earth-900 mb-3">3. QA Check</h3>
                    <p class="text-earth-800/60 font-medium text-sm leading-relaxed">AI analysis of pH levels, moisture, and contamination risks.</p>
                </div>

                <!-- Step 4 -->
                <div class="flow-step relative z-10 glass-card p-8 rounded-[2rem] hover:-translate-y-4 transition-all duration-500 group bg-white/80" style="transition-delay: 300ms;">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-earth-900 mb-3">4. Storage</h3>
                    <p class="text-earth-800/60 font-medium text-sm leading-relaxed">Smart warehousing with dynamic heatmaps and shelf-life prediction.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section with Counter Animation -->
    <section id="stats" class="py-24 bg-earth-900 relative overflow-hidden text-white">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-leaf-400 via-transparent to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div class="stat-item">
                    <div class="text-5xl md:text-6xl font-display font-extrabold text-leaf-400 mb-2"><span class="counter" data-target="98">0</span>%</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-earth-300">Quality Accuracy</div>
                </div>
                <div class="stat-item">
                    <div class="text-5xl md:text-6xl font-display font-extrabold text-citrus-400 mb-2"><span class="counter" data-target="45">0</span>%</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-earth-300">Waste Reduction</div>
                </div>
                <div class="stat-item">
                    <div class="text-5xl md:text-6xl font-display font-extrabold text-blue-400 mb-2"><span class="counter" data-target="2">0</span>x</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-earth-300">Faster Processing</div>
                </div>
                <div class="stat-item">
                    <div class="text-5xl md:text-6xl font-display font-extrabold text-purple-400 mb-2"><span class="counter" data-target="100">0</span>k+</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-earth-300">Batches Managed</div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Analytics Showcase -->
    <section id="analytics" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 gsap-reveal">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-citrus-50 text-citrus-700 text-xs font-bold uppercase tracking-widest mb-6">
                        Predictive Analytics
                    </div>
                    <h2 class="text-4xl md:text-5xl font-display font-extrabold text-earth-900 mb-6 leading-tight">Artificial Intelligence meets Organic Quality.</h2>
                    <p class="text-xl text-earth-800/60 font-medium mb-10 leading-relaxed">
                        Stop guessing. Our proprietary AI models analyze environmental factors to predict exact shelf-life, ensuring maximum nutrient retention and zero spoilage.
                    </p>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-leaf-100 flex items-center justify-center text-leaf-600 flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-earth-900">Real-time Anomaly Detection</h4>
                                <p class="text-earth-800/60 font-medium text-sm mt-1">Instantly flags temperature drops or humidity spikes in storage zones.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-citrus-100 flex items-center justify-center text-citrus-600 flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-earth-900">Dynamic Shelf-life Scoring</h4>
                                <p class="text-earth-800/60 font-medium text-sm mt-1">Calculates freshness decay based on actual processing data, not estimates.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Animated Visual Component -->
                <div class="lg:w-1/2 relative w-full h-[500px]">
                    <div class="absolute inset-0 bg-gradient-to-tr from-leaf-100 to-white rounded-[3rem] shadow-organic transform rotate-3"></div>
                    <div class="absolute inset-0 glass-card rounded-[3rem] p-10 flex flex-col items-center justify-center transform -rotate-3 transition-transform hover:rotate-0 duration-700">
                        
                        <!-- Animated Circular Chart Mockup -->
                        <div class="relative w-64 h-64 flex items-center justify-center">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#f0fdf4" stroke-width="8"></circle>
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#22c55e" stroke-width="8" stroke-dasharray="283" stroke-dashoffset="28" class="animate-[dash_3s_ease-out_forwards]"></circle>
                            </svg>
                            <style>@keyframes dash { from { stroke-dashoffset: 283; } to { stroke-dashoffset: 28; } }</style>
                            <div class="absolute flex flex-col items-center justify-center">
                                <span class="text-5xl font-display font-extrabold text-earth-900">90<span class="text-2xl text-leaf-500">%</span></span>
                                <span class="text-sm font-bold uppercase tracking-wider text-earth-800/50 mt-1">Nutrient Score</span>
                            </div>
                        </div>

                        <!-- Floating AI Card -->
                        <div class="absolute -bottom-6 -left-6 glass-card px-6 py-4 rounded-2xl flex items-center gap-4 animate-float-slow shadow-xl border border-white">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-2xl shadow-sm">🥬</div>
                            <div>
                                <p class="text-xs font-bold text-earth-800/50 uppercase">Batch 009 Status</p>
                                <p class="text-sm font-bold text-leaf-600">Perfect Condition</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-32 relative overflow-hidden bg-earth-900 text-center">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))] from-leaf-900/40 via-earth-900 to-earth-900"></div>
        <div class="relative max-w-4xl mx-auto px-6 z-10 gsap-reveal">
            <h2 class="text-5xl md:text-6xl font-display font-extrabold text-white mb-8 leading-tight">Build a Smarter Food Factory Today.</h2>
            <p class="text-xl text-earth-300 mb-12 font-medium">Join the premium brands optimizing their processing with our AI-driven OS.</p>
            <a href="{{ route('register') ?? '#' }}" class="magnetic-btn inline-flex items-center gap-3 px-10 py-5 rounded-2xl bg-leaf-500 text-white font-bold text-lg hover:bg-leaf-400 transition-colors shadow-[0_0_40px_rgba(34,197,94,0.3)] hover:-translate-y-1">
                Access Platform Now
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-earth-100 py-12 text-center relative z-10">
        <div class="flex justify-center items-center gap-2 mb-6">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-leaf-400 to-leaf-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                SF
            </div>
            <span class="font-display font-bold text-xl text-earth-900">SmartFood<span class="text-leaf-500">.ai</span></span>
        </div>
        <p class="text-earth-800/50 font-medium text-sm">© {{ date('Y') }} Smart Food Processing System. High-End Food-Tech.</p>
    </footer>

    <!-- GSAP Animations Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Animations
            const tl = gsap.timeline();
            tl.to('.hero-badge', { y: 0, opacity: 1, duration: 0.8, ease: "power3.out" })
              .to('.word-reveal span', { y: 0, opacity: 1, duration: 0.8, stagger: 0.2, ease: "back.out(1.7)" }, "-=0.4")
              .to('.hero-text', { y: 0, opacity: 1, duration: 0.8, ease: "power3.out" }, "-=0.4")
              .to('.hero-ctas', { y: 0, opacity: 1, duration: 0.8, ease: "power3.out" }, "-=0.6")
              .to('.hero-image', { y: 0, opacity: 1, duration: 1.2, ease: "power4.out" }, "-=0.4");

            // Scroll Reveal Elements
            gsap.utils.toArray('.gsap-reveal').forEach(elem => {
                gsap.to(elem, {
                    scrollTrigger: { trigger: elem, start: "top 85%" },
                    y: 0, opacity: 1, duration: 1, ease: "power3.out"
                });
            });

            // Flow Steps Stagger
            gsap.from('.flow-step', {
                scrollTrigger: { trigger: '#processing', start: "top 70%" },
                y: 50, opacity: 0, duration: 0.8, stagger: 0.2, ease: "power3.out"
            });

            // Number Counter Animation
            gsap.utils.toArray('.counter').forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                ScrollTrigger.create({
                    trigger: '#stats',
                    start: "top 75%",
                    onEnter: () => {
                        gsap.to(counter, {
                            innerHTML: target,
                            duration: 2,
                            snap: { innerHTML: 1 },
                            ease: "power2.out"
                        });
                    },
                    once: true
                });
            });

            // Magnetic Button Effect setup
            document.querySelectorAll('.magnetic-btn').forEach(btn => {
                btn.addEventListener('mousemove', (e) => {
                    const rect = btn.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    gsap.to(btn, { x: x * 0.2, y: y * 0.2, duration: 0.3, ease: "power2.out" });
                });
                btn.addEventListener('mouseleave', () => {
                    gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: "elastic.out(1, 0.3)" });
                });
            });
        });
    </script>
</body>
</html>
