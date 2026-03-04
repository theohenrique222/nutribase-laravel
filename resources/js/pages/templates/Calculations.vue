<template>
    <section id="calculations" class="bg-[url('img/background3.jpg')] bg-cover w-full lg:h-screen min-h-screen">
        <div
            class="flex flex-col-reverse lg:flex-row w-full px-2 sm:px-3 lg:max-w-6xl md:max-w-3xl sm:max-w-xl max-w-xs m-auto lg:my-0 my-10 space-x-10">
            <div class="flex lg:flex-col flex-col-reverse w-full m-auto lg:h-screen text-start">
                <div class="flex flex-col flex-grow justify-center">
                    <h2 data-aos="fade-up" data-aos-duration="700"
                        class="uppercase text-lime-400 font-extrabold text-3xl md:text-4xl lg:text-4xl py-4">
                        Otimize sua Saúde com Cálculos <span class="text-neutral-200"> Personalizados</span>
                    </h2>
                    <h3 data-aos="fade-up" data-aos-duration="1000"
                        class="uppercase text-lime-400 font-medium text-base md:text-lg py-3">
                        Descubra os números ideais para sua alimentação e bem-estar!
                    </h3>
                    <p data-aos="fade-up" data-aos-duration="1000"
                        class="text-neutral-100 font-extralight text-base md:text-lg">
                        Cada organismo tem necessidades específicas. Com nossos cálculos personalizados, você saberá
                        exatamente quantas calorias consumir, como dividir seus macronutrientes, a quantidade ideal de
                        água por dia e sua porcentagem de gordura corporal. Faça escolhas mais inteligentes para
                        alcançar seus objetivos!
                    </p>

                    <div data-aos="fade-up" data-aos-duration="1000"
                        class="lg:flex lg:flex-row flex-col lg:py-0 py-2 text-center w-full mt-10 border-2 border-lime-500">
                        <template v-for="(item, index) in links" :key="item.id">
                            <div @click="openDialog(item)"
                                class="w-full p-3 hover:bg-lime-500/30 cursor-pointer transition-all">
                                <h3 class="lg:text-sm text-base text-lime-500">
                                    {{ item.title }}
                                </h3>
                                <h3 class="text-white text-sm font-extralight">
                                    {{ item.button }}
                                </h3>
                            </div>
                            <div v-if="index < links.length - 1"
                                class="bg-neutral-100 m-auto w-2/3 h-px lg:w-px lg:h-2/3"></div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-md overflow-hidden flex justify-center"></div>
        </div>
    </section>

    <Dialog v-model:visible="visible" modal :header="selectedItem?.title || 'Detalhes'" :style="{ width: '25rem' }">
        <span class="text-surface-500 block mb-8">
            O que é <strong>{{ selectedItem?.title }}</strong>?
        </span>
        <p class="text-sm text-neutral-200">{{ selectedItem?.description || "Sem descrição disponível." }}</p>
        <div class="flex justify-end gap-2 mt-4">
            <Button type="button" label="Fechar" severity="secondary" @click="visible = false"></Button>
            <Button type="button" label="Acessar"></Button>
        </div>
    </Dialog>
</template>

<script lang="ts">
export default {
    name: "Calculations",
    data() {
        return {
            visible: false,
            selectedItem: null,
            links: [
                {
                    id: 1,
                    title: "Metabolismo Basal",
                    button: "Calcule agora!",
                    href: "/basal_metabolism",
                    description: "O metabolismo basal (MB) é a energia mínima que seu corpo precisa para manter funções vitais em repouso."
                },
                {
                    id: 2,
                    title: "Gordura corporal",
                    button: "Calcule agora!",
                    href: "/bodyfat",
                    description: "A gordura corporal aproximada é a porcentagem de gordura no corpo em relação ao peso total, estimada com base em peso, altura, idade e sexo."
                },
                {
                    id: 3,
                    title: "Macronutrientes",
                    button: "Calcule agora!",
                    href: "/macronutrients",
                    description: "O cálculo de macronutrientes determina a quantidade ideal de proteínas, carboidratos e gorduras que você deve consumir diariamente, de acordo com seu peso, nível de atividade e objetivo."
                },
                {
                    id: 4,
                    title: "Água diária",
                    button: "Calcule agora!",
                    href: "/water_intake",
                    description: "Descubra a quantidade ideal de água para consumir diariamente."
                }
            ]
        };
    },
    // methods: {
    //     openDialog(item) {
    //         this.selectedItem = item;
    //         this.visible = true;
    //     },
    //     goToPage(url) {
    //         if (url) {
    //             window.location.href = url;
    //         }
    //     }
    // }
};
</script>
