import {defineStore} from "pinia";
import {computed} from "vue";

export const useStatisticsStore = defineStore('statisticsStore', () => {
    const years = async () => {
        let years
        await axios.post('/api/statistics/years').then((response) => {
            years = response.data
        });

        return years
    }

    const byRegion = async (chartData, year) => {
        await axios.post('/api/statistics/by-regions', {
            year: year.value
        }).then((response) => {
            chartData.value.labels = response.data.map(region => region.name)
            chartData.value.datasets[0].data = response.data.map(region => region.supports_count)
        });
    }

    const byCompanyType = async (chartData, year) => {
        await axios.post('/api/statistics/by-company-type', {
            year: year.value
        }).then((response) => {
            chartData.value.datasets = []

            const support = {
                label: 'Кол-во поддержки',
                data: []
            }

            Object.keys(response.data).map((ownerType) => {
                response.data[ownerType].forEach(companyType => {
                    if (companyType.name === 'Самозанятые') {
                        support.data[3] = companyType.supports_count
                    } else {
                        support.data.push(companyType.supports_count)
                    }

                    chartData.value.labels.indexOf(companyType.name) === -1 ? chartData.value.labels.push(companyType.name) : ''
                })

                chartData.value.datasets.push(support)
            })
        });
    }

    const bySupportType = async (chartData, year) => {
        await axios.post('/api/statistics/by-support-type', {
            year: year.value
        }).then((response) => {
            chartData.value.labels = Object.keys(response.data)
            chartData.value.datasets = []

            const labels = [
                'Рубли',
                'Единицы',
                'Часы',
                'Квадратные метры'
            ]

            Object.keys(response.data).forEach((companyType, i) => {
                const support = {
                    label: labels[i],
                    data: response.data[companyType].map((supportType) => supportType.supports_count)
                }

                chartData.value.datasets.push(support)
            })
        })
    }

    return {
        years,
        byRegion,
        byCompanyType,
        bySupportType
    }
})
