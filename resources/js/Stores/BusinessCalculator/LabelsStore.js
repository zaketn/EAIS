import {defineStore} from "pinia";
import {ref} from "vue";

export const useLabelsStore = defineStore('bcLabelsStore', () => {
    const inputLabels = ref({
        equipment_and_machinery: 'Оборудование и техника (офисное, торговое, кассовое, компьтеры)',
        technology_development: 'Разработка технологий',
        buying_property: 'Покупка собственной недвижимости',
        stock: 'Складской запас (товары, материалы)',
        working_capital: 'Оборотный капитал',
        total_investment_volume: 'Итого, объем инвестиций',

        salaries_employees: 'ФОТ - все оклады сотрудникам, без учета налогов',
        communication_software_rental: 'Связь и интернет, аренда ПО и софта',
        office_or_retail_space_rental: 'Аренда офиса или торговой точки',
        loan_interest_expenses: 'Сумма процентов переплаты по кредиту',
        other_administrative_expenses: 'Прочие административные расходы',
        total_fixed_costs_including_all_employee_taxes: 'Итого постоянные затраты, с учетом всех налогов на ФОТ',

        monthly_advertising_expenses: 'Сумма затрат на рекламу за месяц',
        customer_retention_expenses: 'Сумма на удержание (возврат) клиентов',
        manager_bonus_percentage: 'Процент премии менеджерам, % (0, если нет процента с продаж)',
        delivery_cost_per_transaction: 'Стоимость доставки покупки до клиента, на один чек',
        acquiring_fee_percentage: 'Эквайринг %',
        total_variable_costs: 'Итого переменные затраты',

        average_purchase_price_per_unit: 'Средняя закупочная цена одного товара/услуги',
        supplier_delivery_cost_per_unit: 'Стоимость доставки товара от поставщика, на одну единицу',
        total_cost_price_per_unit: 'Итого себестоимость единицы товара/услуги',
        average_retail_price_per_unit: 'Средняя розничная цена единицы товара/услуги, руб',
        markup_percentage: 'Наценка в %',

        advertising_campaign_coverage: 'Охват рекламной кампании',
        website_store_conversion_rate: 'Конверсия на сайт / магазин, %',
        conversion_to_cart_lead_consultation_rate: 'Конверсия в оформленную корзину, лид, консультацию %',
        payment_conversion_rate: 'Конверсия в оплату, %',
        number_of_past_customers: 'Количество тех, кто у вас уже покупал в прошлом',
        repeat_purchase_conversion_rate: 'Конверсия в повторные покупки, %',
        average_number_of_items_per_transaction: 'Среднее количество товаров/услуг в чеке, шт.',

        website_or_offline_store_visitors: 'Посетители сайта или офлайн магазина',
        abandoned_carts_leads_consultations_in_offline_store: 'Количество корзин без оплаты, лидов, консультаций',
        number_of_sales_to_new_customers: 'Количество продаж (чеков) новым клиентам',
        number_of_repeat_sales: 'Количество повторных продаж (чеков)',
        total_number_of_sales: 'Общее количество продаж (чеков)',
        average_transaction_value: 'Средний чек, руб.',

        customer_acquisition_retention_cost_per_buyer: 'Стоимость привлечения + удержания, на одного покупателя, руб.',
        sales_bonus_employee_costs_per_sale_including_taxes: 'ФОТ премиальной части за продажи, на одну продажу (чек), с учетом налогов',
        variable_costs_per_sale: 'Переменные затраты на одну продажу (чек)',
        margin_per_sale: 'Маржинальность на один продажу (чек)',
        break_even_point_in_number_of_sales: 'Точка безубыточности, количество продаж (чеков)',
        break_even_revenue_in_rubles: 'Точка безубыточности, выручка в рублях',
        number_of_sales_needed_to_reach_1_million_rubles_profit: 'Чтобы выйти на 1 млн. руб. прибыли до налогов, нужно делать продаж (чеков)',

        revenue_in_rubles: 'Выручка, рубли',
        gross_profit_in_rubles: 'Маржинальная прибыль, рубли',
        profit_before_taxes_in_rubles: 'Прибыль до налогов, рубли',
        investment_payback_period_in_months: 'Сроки окупаемости инвестиций, месяцев (без учета налогов на прибыль)',
        return_on_investment_annualized_without_tax: 'ROI (возврат инвестиций за год, без учета налогов)'
    })

    const inputPopovers = ref({
        technology_development: 'Изобретения, патенты или например просто запуск сайта или приложения.',
        working_capital: 'Переменные + постоянные затраты (без учета дебиторки и складских запасов) доход домашнего хозяйства',

        salaries_employees: 'Сумма всех окладов без учета премий',
        loan_interest_expenses: 'Не ежемесячный платеж! А сумма ежемесячной переплаты банку',
        customer_retention_expenses: 'Разовые скидки, списанные бонусы за повторную покупку, звонки клиентам от менеджеров, расходы на CRM маркетинг, ретаргетинг на тех, кто уже покупал',
        delivery_cost_per_transaction: 'Если не доставляете клиенту, или он оплачивает отдельно, то укажите 0',
        acquiring_fee_percentage: 'Около 2%, можно указать 1%, если половина выручки наличными',
        average_purchase_price_per_unit: 'Для услуги умножьте себестоимость часа вашего работника на кол-во часов в одной услуге',
        supplier_delivery_cost_per_unit: 'Разделите сумму расходов за доставку от поставщика на кол-во всех товаров (для производства так же, но про поставку материалов)',

        advertising_campaign_coverage: 'Или трафик в ТЦ для офлайн магазина, или количество контактов (звонков) менеджеров',
        website_store_conversion_rate: 'Или конверсия в "успешный контакт (звонок)"',
        conversion_to_cart_lead_consultation_rate: 'Или в назначенную встречу',
        payment_conversion_rate: 'Или подписанный договор и оплаченный счет',
        number_of_past_customers: 'Сколько постоянных или лояльных клиентов, или например "оставленных" корзин или "пользователей"',
        repeat_purchase_conversion_rate: 'Конверсия в оплату для постоянных клиентов, те кто продлил подписку, сделал очередной заказ, оплатил ежемесячный счет',
        average_number_of_items_per_transaction: 'Продажи в штуках/на количество чеков\n' +
            'Общее для всех и новых и постоянных клиентов',

        website_or_offline_store_visitors: 'Успешных контактов или звонков',
        abandoned_carts_leads_consultations_in_offline_store: 'Количество корзин без оплаты, лидов, консультаций',
        total_number_of_sales: 'Количество продаж новым клиентам + повторные продажи',
        average_transaction_value: 'Средняя розничная цена * количество товаров в чеке',

        customer_acquisition_retention_cost_per_buyer: 'Общая сумма на привлечение и удержание на каждого клиента',
        sales_bonus_employee_costs_per_sale_including_taxes: 'Расходы на премии за продажи на каждую сделку',
        variable_costs_per_sale: 'Привлечение и удержание + премии за продажу + доставка до клиента + проценты за эквайринг',
        margin_per_sale: 'Средний чек - переменные затраты на один чек',
        break_even_point_in_number_of_sales: 'Постоянные затраты / маржинальность одной продажи (чека)',
        break_even_revenue_in_rubles: 'Точка безубыточности в чеках * средний чек',
        number_of_sales_needed_to_reach_1_million_rubles_profit: 'Количество продаж (чеков) в точке безубыточности + 1млн./маржинальность одной продажи',

        revenue_in_rubles: 'Количество чеков*средний чек',
        gross_profit_in_rubles: 'Выручка - переменные затраты',
        profit_before_taxes_in_rubles: 'Маржинальная прибыль - постоянные затраты',
        investment_payback_period_in_months: 'Инвестиции/прибыль до налогов',
        return_on_investment_annualized_without_tax: 'Прибыль до налогов за год/объем инвестиций'
    })

    return { inputLabels, inputPopovers }
})
