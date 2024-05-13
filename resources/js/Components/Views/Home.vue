<script setup>

import NavigationCards from "@/Components/Modules/NavigationCards.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
</script>

<template>
    <Suspense>
        <Navbar />
    </Suspense>

        <div class="container mx-auto p-3">
            <div class="flex flex-wrap justify-center gap-8 md:flex-col">
                <Suspense>
                    <NavigationCards />
                </Suspense>
            </div>
        </div>
</template>

<style scoped>

</style>
