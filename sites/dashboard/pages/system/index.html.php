---
@layout: 
    path: /default


name: System
title: Joomlatools Server System Information
---

        <section class="max-w-7xl mx-auto py-4 px-5">
            <div class="flex justify-between items-center border-b border-gray-300">
                <h1 class="text-2xl font-semibold pt-2 pb-6">System information tools</h1>
                
            </div>
        </section>

         <section class="max-w-7xl mx-auto py-4 pb-8 px-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="bg-white p-4 shadow rounded-lg transition duration-500 ease-in-out transform hover:scale-105">
                    <a href="/system/dozzle" class="flex flex-col items-center justify-center">
                        <div class="inline-flex shadow-lg border border-gray-200 rounded-full overflow-hidden h-40 w-40">
                            <img src="images://app-logos/dozzle.jpg"
                            alt=""
                            class="h-full w-full">
                        </div>

                        <h2 class="mt-4 font-bold text-xl">Logs</h2>
                        <h6 class="mt-2 text-sm font-medium">Dozzle</h6>

                        <p class="text-xs text-gray-500 text-center mt-3">
                            Dozzle is a simple and responsive application that provides you with a web based interface to monitor your Docker container logs live.
                        </p>
                    </a>
                </div>

                <div class="bg-white p-4 shadow rounded-lg transition duration-500 ease-in-out transform hover:scale-105">
                    <a href="/system/traefik" class="flex flex-col items-center justify-center">
                        <div class="inline-flex shadow-lg border border-gray-200 rounded-full overflow-hidden h-40 w-40">
                            <img src="images://app-logos/traefik-proxy-logo.jpg"
                            alt=""
                            class="h-full w-full">
                        </div>

                        <h2 class="mt-4 font-bold text-xl">Proxy</h2>
                        <h6 class="mt-2 text-sm font-medium">Traefik</h6>

                        <p class="text-xs text-gray-500 text-center mt-3">
                            Traefik is a modern HTTP reverse proxy and load balancer that makes deploying microservices easy.
                        </p>
                    </a>
                </div>

            </div>
            
        </section>