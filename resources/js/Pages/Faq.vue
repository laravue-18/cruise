<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavMenu from '@/Shared/NavMenu.vue';
import Footer from '@/Shared/Footer.vue';
import MyCollapse from '@/Components/collapse/MyCollapse.vue';
import MyPanel from '@/Components/collapse/MyPanel.vue';
</script>

<template>
    <Head title="FAQ" />

    <section class="bg-[#DC76190D]">
        <NavMenu />
        <div class="container">
            <div class="px-4 py-20 lg:py-40 text-center lg:w-3/4 mx-auto">
                <h6 class="text-[#B65C08] text-lg font-poppins font-semibold">Frequently asked question</h6>
                <h3 class="text-6xl font-medium mt-11 mb-44">
                    Wise Questions, Answered!
                </h3>
                <p class="font-poppins text-2xl mb-8">
                    Jump To A Topic
                </p>
                <div class="flex justify-center divide-x">
                    <div class="text-2xl text-[#191919] font-medium px-6 py-4">Pre-Existing Conditions</div>
                    <div class="text-2xl text-[#191919] font-medium px-6 py-4">CFAR</div>
                    <div class="text-2xl text-[#191919] font-medium px-6 py-4">Claims</div>
                    <div class="text-2xl text-[#191919] font-medium px-6 py-4">Cruises</div>
                    <div class="text-2xl text-[#191919] font-medium px-6 py-4">Age Limits</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pre-Existing Conditions -->
    <section class="container px-12 lg:px-20 xl:px-32 2xl:px-48 pt-20 lg:pt-36">
        <h2 class="text-3xl lg:text-4xl font-medium mb-8 lg:mb-24">Pre-Existing Conditions</h2>
        <MyCollapse>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">How can I ensure pre-existing conditions are covered?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
        </MyCollapse>
    </section>

    <!-- CFAR -->
    <section class="container px-12 lg:px-20 xl:px-32 2xl:px-48 pt-20 lg:pt-36">
        <h2 class="text-3xl lg:text-4xl font-medium mb-8 lg:mb-24">CFAR</h2>
        <MyCollapse>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">How can I ensure pre-existing conditions are covered?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
        </MyCollapse>
    </section>
    
    <!-- Claims -->
    <section class="container px-12 lg:px-20 xl:px-32 2xl:px-48 pt-20 lg:pt-36">
        <h2 class="text-3xl lg:text-4xl font-medium mb-8 lg:mb-24">Claims</h2>
        <MyCollapse>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">How can I ensure pre-existing conditions are covered?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
        </MyCollapse>
    </section>
    
    <!-- Cruises -->
    <section class="container px-12 lg:px-20 xl:px-32 2xl:px-48 pt-20 lg:pt-36">
        <h2 class="text-3xl lg:text-4xl font-medium mb-8 lg:mb-24">Cruises</h2>
        <MyCollapse>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">How can I ensure pre-existing conditions are covered?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
        </MyCollapse>
    </section>
    
    <!-- Age Limits -->
    <section class="container px-12 lg:px-20 xl:px-32 2xl:px-48 pt-20 lg:pt-36">
        <h2 class="text-3xl lg:text-4xl font-medium mb-8 lg:mb-24">Cruises</h2>
        <MyCollapse>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">How can I ensure pre-existing conditions are covered?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
            <MyPanel>
                <p class="text-2xl lg:text-4xl text-[#484848] py-6 lg:py-12">Does Medicare provide coverage abroad?</p>
                <template #content>
                    <p class="text-lg lg:text-xl text-[#19191999] pb-12">
                        After decades of serving a diverse range of travelers, our founders, discovered their richest 
                        source of learning often came from their most seasoned clients.
                    </p>
                </template>
            </MyPanel>
        </MyCollapse>
    </section>

    <Footer/>
</template>

<style>
</style>
