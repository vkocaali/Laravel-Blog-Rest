<template>
    <div class="rounded flex md:shadow mt-12">
        <img src="https://images.unsplash.com/photo-1579275542618-a1dfed5f54ba?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=900&q=60" class="w-0 md:w-1/4 object-cover rounded-l" />
        <div class="px-4 py-2">
            <h3 class="text-3xl text-gray-800 font-bold">Gönderilere Abone Ol</h3>
            <p class="text-xl text-gray-700">Yeni bir makale yayınlandığında sana bildirelim.</p>
            <form class="mt-4 mb-10">
                <input type="email" class="rounded bg-gray-100 px-4 py-2 border focus:border-red-400" placeholder="merhaba@volkankocaali.com"/>
                <button class="px-4 py-2 rounded bg-red-800 text-gray-100">
                    Abone Ol
                    <i class='bx bx-right-arrow-alt' ></i>
                </button>
                <p class="text-red-900 opacity-50 text-sm mt-1">Spam yapmıyoruz , Söz</p>
            </form>
        </div>
    </div>
</template>
