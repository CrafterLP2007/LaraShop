<div class="drawer drawer-end">
    <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col items-center justify-center">
        <!-- Seiteinhalt hier -->
        <label for="my-drawer-4" class="drawer-button btn btn-neutral fixed bottom-0 right-0 m-6 shadow-lg h-16 w-16 rounded-full ">
            <i class="icon-shopping-cart text-lg"></i>
        </label>
    </div>
    <div class="drawer-side">
        <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-96 p-4">
            <div class="flex items-center mt-4">
                <h1 class="text-xl font-semibold">Einkaufswagen</h1>
                <button class="btn btn-circle btn-ghost ml-auto drawer-overlay" aria-label="close sidebar" for="my-drawer-4">
                    <i class="icon-x text-lg"></i>
                </button>
            </div>

            <div class="divider"></div>

            <div class="space-y-4 mt-12">
                <div class="flex justify-between items-center gap-4">
                    <div class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200 flex items-center justify-center">
                        <img src="https://tailwindui.com/plus/img/ecommerce-images/shopping-cart-page-04-product-01.jpg" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="size-full object-cover">
                    </div>
                    <div class="flex flex-col items-start w-full">
                        <div class="flex gap-6 flex-wrap justify-between">
                            <h1 class="text-lg font-semibold">Title of Product</h1>
                            <span class="text-lg">12.33€</span>
                        </div>

                        <span class="text-sm truncate max-w-56">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et quam est. Sed et quam est.</span>

                        <div class="flex items-center justify-between">
                            <div class="flex gap-4 border border-neutral">
                                <button class="btn btn-sm btn-ghost">-</button>
                                <span>1</span>
                                <button class="btn btn-sm btn-ghost">+</button>
                            </div>

                            <button class="btn btn-ghost mt-4">Entfernen</button>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>
