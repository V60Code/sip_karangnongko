<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Karangnongko Farm - Manajemen Ternak Digital</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .card-hover {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
        </style>
    </head>
    <body class="bg-gray-50">
        <!-- Header -->
        <header class="gradient-bg text-white">
            <div class="container mx-auto px-6 py-16">
                <div class="text-center">
                    <h1 class="text-5xl font-bold mb-4">Karangnongko Farm</h1>
                    <p class="text-xl mb-8 opacity-90">Manajemen Ternak Digital untuk Produktivitas Optimal</p>
                    <div class="flex justify-center space-x-4">
                        <a href="/admin" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Masuk ke Dashboard
                        </a>
                        <a href="#features" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Teknologi Digital untuk Peternakan Modern</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Karangnongko Farm memanfaatkan teknologi digital untuk mengelola data kambing secara efektif, 
                        mulai dari pencatatan kelahiran, pertumbuhan, kesehatan, hingga reproduksi, 
                        guna meningkatkan produktivitas dan kesejahteraan ternak.
                    </p>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                    <p class="text-lg text-gray-600">Solusi lengkap untuk manajemen peternakan modern</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-xl p-8 shadow-lg card-hover">
                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Manajemen Data Ternak</h3>
                        <p class="text-gray-600">
                            Kelola data ternak dengan lebih efisien — mulai dari berat, umur, hingga riwayat kesehatan, 
                            semua tercatat secara digital dan terpusat.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-xl p-8 shadow-lg card-hover">
                        <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Pencatatan Pakan Harian</h3>
                        <p class="text-gray-600">
                            Tandai dan catat setiap kali kambing diberi pakan, lengkap dengan waktu dan jenis pakan. 
                            Membantu peternak memantau rutinitas harian dengan rapi dan terstruktur.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-xl p-8 shadow-lg card-hover">
                        <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Monitoring Kesehatan</h3>
                        <p class="text-gray-600">
                            Catat gejala, tindakan, dan riwayat kesehatan setiap kambing. 
                            Bantu deteksi dini dan perawatan lebih cepat sebelum kondisi memburuk.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">100%</div>
                        <div class="text-gray-600">Digital</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">24/7</div>
                        <div class="text-gray-600">Monitoring</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">Real-time</div>
                        <div class="text-gray-600">Data</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">Efisien</div>
                        <div class="text-gray-600">Manajemen</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 gradient-bg text-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4">Siap Memulai Peternakan Digital?</h2>
                <p class="text-xl mb-8 opacity-90">Bergabunglah dengan revolusi teknologi peternakan modern</p>
                <a href="/admin" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300">
                    Akses Dashboard Sekarang
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Karangnongko Farm</h3>
                        <p class="text-gray-400">
                            Sistem manajemen peternakan digital yang membantu peternak 
                            mengelola ternak dengan lebih efisien dan produktif.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Fitur</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>Manajemen Data Ternak</li>
                            <li>Pencatatan Pakan</li>
                            <li>Monitoring Kesehatan</li>
                            <li>Laporan & Analitik</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Kontak</h3>
                        <div class="text-gray-400">
                            <p>Yayasan Satu Nami Indonesia</p>
                            <p class="mt-2">Email: info@ppmcal.com</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} Karangnongko Farm. Dikembangkan dengan ❤️ untuk peternakan modern.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
