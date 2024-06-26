import {defineStore} from "pinia";
import {ref} from "vue";

export const useAiRecommendationsStore = defineStore('aiRecommendationsStore', () => {
    const fields = ref([
        {
            name: 'Основные',
            items: [
                {
                    name: 'Сфера деятельности',
                    popover: 'Розничная торговля, общественное питание, услуги, производство, онлайн-бизнес...'
                },
                {
                    name: 'Размер бизнеса',
                    popover: 'Микробизнес (1-10 сотрудников), малый бизнес (10-50 сотрудников), средний бизнес (50-250 сотрудников)'
                },
                {
                    name: 'Географическое расположение',
                    popover: 'Город, область, страна'
                },
                {
                    name: 'Целевая аудитория',
                    popover: 'Кого обслуживает бизнес (пол, возраст, интересы, доход)'
                },
                {
                    name: 'Основные конкуренты',
                    popover: 'Ключевые конкуренты на рынке.'
                },
                {
                    name: 'Бизнес-модель',
                    popover: 'B2B, B2C, D2C, подписка, франшиза...'
                },
                {
                    name: 'Стадия развития',
                    popover: 'Стартап, ранний рост, зрелость...'
                }
            ]
        },
        {
            name: 'Финансовые',
            items: [
                {
                    name: 'Средний чек',
                    popover: null
                },
                {
                    name: 'Выручка за последний период',
                    popover: null
                },
                {
                    name: 'Рентабельность',
                    popover: 'Процент прибыли от выручки.'
                }
            ]
        },
        {
            name: 'Маркетинг',
            items: [
                {
                    name: 'Маркетинговые каналы',
                    popover: 'Социальные сети, контекстная реклама, SEO, email-маркетинг, печатная реклама...'
                },
                {
                    name: 'Бюджет на маркетинг',
                    popover: null
                },
            ]
        },
        {
            name: 'Дополнительно',
            items: [
                {
                    name: 'Проблемы бизнеса',
                    popover: 'Трудности, с которыми сталкивается бизнес'
                },
                {
                    name: 'Цели бизнеса',
                    popover: 'Чего хочет достичь бизнес в ближайшее время'
                },
            ]
        }
    ])

    return {
        fields
    }
})
