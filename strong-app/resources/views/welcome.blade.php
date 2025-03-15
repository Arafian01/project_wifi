<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Modern Landing Page | Tailwind Template</title>
    <meta name="description" content="Modern landing page design with Tailwind CSS" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      .gradient {
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
      }
      .wave-top {
        transform: rotate(180deg);
      }
      .hover-scale {
        transition: transform 0.3s ease;
      }
      .hover-scale:hover {
        transform: translateY(-5px);
      }
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
  </head>

  <body class="leading-normal tracking-normal text-gray-900">
    <!-- Navigation -->
    <nav id="header" class="fixed w-full z-30 top-0 bg-white/80 backdrop-blur-md">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-4">
        <div class="pl-4 flex items-center">
          <a class="flex items-center text-2xl font-bold text-gray-900" href="#">
            <svg class="h-8 w-8 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 0l-5.5 11.25h3.5v7.5h4v-7.5h3.5z"/>
            </svg>
            <span class="ml-2">Digital</span>
          </a>
        </div>
        <div class="block lg:hidden pr-4">
          <button id="nav-toggle" class="flex items-center p-1 hover:text-indigo-600">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
          <ul class="list-reset lg:flex justify-end flex-1 items-center">
            <li class="mr-3">
              <a class="inline-block py-2 px-4 font-medium hover:text-indigo-600" href="#">Product</a>
            </li>
            <li class="mr-3">
              <a class="inline-block py-2 px-4 font-medium hover:text-indigo-600" href="#">Features</a>
            </li>
            <li class="mr-3">
              <a class="inline-block py-2 px-4 font-medium hover:text-indigo-600" href="#">Pricing</a>
            </li>
          </ul>
          <button class="ml-4 gradient text-white font-medium rounded-lg px-6 py-2 shadow-lg hover:shadow-xl transition-all">
            Get Started
          </button>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="pt-32 pb-24 bg-gradient-to-b from-indigo-50 to-white">
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center">
          <div class="w-full lg:w-1/2 text-center lg:text-left">
            <h1 class="text-5xl lg:text-6xl font-bold leading-tight mb-6">
              Transform Your Digital Presence
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
              Create stunning digital experiences with our all-in-one platform. Perfect for businesses looking to accelerate their online growth.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <button class="gradient text-white px-8 py-4 rounded-lg font-medium hover-scale shadow-lg">
                Start Free Trial
              </button>
              <button class="bg-white text-gray-900 px-8 py-4 rounded-lg font-medium border-2 border-gray-200 hover:border-indigo-300 hover-scale">
                Watch Demo
              </button>
            </div>
          </div>
          <div class="w-full lg:w-1/2 mt-12 lg:mt-0">
            <img src="https://cdn.devdojo.com/images/march2021/hero-image.png" class="w-full h-auto max-w-2xl mx-auto" alt="Hero Illustration">
          </div>
        </div>
      </div>
    </div>

    <!-- Features Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">Amazing Features</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">Everything you need to build modern websites and applications</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="p-8 rounded-xl bg-white hover-scale shadow-lg border border-gray-100">
            <div class="w-12 h-12 gradient rounded-lg flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-4">Lightning Fast</h3>
            <p class="text-gray-600">Optimized performance for all devices with our cloud-based infrastructure.</p>
          </div>
          
          <div class="p-8 rounded-xl bg-white hover-scale shadow-lg border border-gray-100">
            <div class="w-12 h-12 gradient rounded-lg flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-4">Secure Platform</h3>
            <p class="text-gray-600">Enterprise-grade security with end-to-end encryption and regular audits.</p>
          </div>

          <div class="p-8 rounded-xl bg-white hover-scale shadow-lg border border-gray-100">
            <div class="w-12 h-12 gradient rounded-lg flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-4">Easy Customization</h3>
            <p class="text-gray-600">Flexible components and templates that adapt to your brand.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient text-white py-20">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of satisfied customers and transform your business today</p>
        <button class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 hover-scale shadow-lg">
          Start Your Free Trial
        </button>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
      <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8">
          <div class="mb-8">
            <h4 class="text-white font-semibold mb-4">Company</h4>
            <ul class="space-y-2">
              <li><a href="#" class="hover:text-white transition">About</a></li>
              <li><a href="#" class="hover:text-white transition">Careers</a></li>
              <li><a href="#" class="hover:text-white transition">Contact</a></li>
            </ul>
          </div>
          <div class="mb-8">
            <h4 class="text-white font-semibold mb-4">Resources</h4>
            <ul class="space-y-2">
              <li><a href="#" class="hover:text-white transition">Documentation</a></li>
              <li><a href="#" class="hover:text-white transition">Guides</a></li>
              <li><a href="#" class="hover:text-white transition">API Reference</a></li>
            </ul>
          </div>
          <div class="mb-8">
            <h4 class="text-white font-semibold mb-4">Legal</h4>
            <ul class="space-y-2">
              <li><a href="#" class="hover:text-white transition">Privacy</a></li>
              <li><a href="#" class="hover:text-white transition">Terms</a></li>
              <li><a href="#" class="hover:text-white transition">Security</a></li>
            </ul>
          </div>
          <div class="mb-8">
            <h4 class="text-white font-semibold mb-4">Connect</h4>
            <div class="flex space-x-4">
              <a href="#" class="hover:text-white transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
              </a>
              <a href="#" class="hover:text-white transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z"/></svg>
              </a>
              <a href="#" class="hover:text-white transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
              </a>
            </div>
          </div>
        </div>
        <div class="pt-8 mt-8 border-t border-gray-800 text-center">
          <p class="text-gray-500">&copy; 2023 Your Company. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html> 