<script>
import { ref, onMounted } from 'vue';
import { CChart } from '@coreui/vue-chartjs';
import { getStyle } from '@coreui/utils';

export default {
  components: { CChart },
  data() {
    return {
      widgetChartRef1: null,
      widgetChartRef2: null,
      customerCountData: 0,
      monthlyIncomeData: [],
      monthLabels: [],
      monthlyIncome: [],
      totalIncome: 0,
      serviceDetails: [],
      servicesCompleted: 0,
      servicesPending: 0,
      monthlyServiceDetails: [],
      monthLabelForServiceDetails: [],
      monthlyServiceData: [],
      totalServiceData: 0,
      sidebarData: null,
      dashBoardPermission: null,
    };
  },
  created(){
    this.fetchCustomerCountData();
    this.getMonthlyIncome();
    this.getMonthlyServiceDetails();
    this.getServiceDetails();
  },
  mounted() {
    this.sidebarData = this.$store.getters.getSubMenus;
    // console.log("sidebarData", this.sidebarData);
    this.dashBoardPermission = this.$store.getters.getSubmenuPermissions[0];
    document.documentElement.addEventListener('ColorSchemeChange', () => {
      if (this.widgetChartRef1) {
        this.widgetChartRef1.chart.data.datasets[0].pointBackgroundColor = getStyle('--cui-primary');
        this.widgetChartRef1.chart.update();
      }

      if (this.widgetChartRef2) {
        this.widgetChartRef2.chart.data.datasets[0].pointBackgroundColor = getStyle('--cui-info');
        this.widgetChartRef2.chart.update();
      }
    });
  },
  methods: {
    async fetchCustomerCountData(){
        try {
            const response = await axios.get('get-customer-count');
            this.customerCountData = response.data.customerCount;
        } catch (error) {
            // console.log(error);
        }
    },
    async getMonthlyIncome(){
        try {
            const response = await axios.get('get-monthly-income');
            this.monthlyIncomeData = response.data;
            this.filterMonthlyIncome();
        } catch (error) {
            // console.log(error);
        }
    },
    async getServiceDetails(){
      try {
        const response = await axios.get('get-service-details-dashboard');
        this.serviceDetails = response.data;
        this.serviceDetails.forEach((data) => {
          if(data.service_status == 1 || data.service_status == 2){
            this.servicesPending += data.count;
          } else {
            this.servicesCompleted = data.count
          }
        })
      } catch (error) {
          // console.log(error);
      }
    },
    async getMonthlyServiceDetails(){
      try {
        const response = await axios.get('get-monthly-service-details');
        this.monthlyServiceDetails = response.data;
        this.monthLabelForServiceDetails = this.monthlyServiceDetails.map((data) => data.month);
        this.monthlyServiceData = this.monthlyServiceDetails.map((data) => parseFloat(data.count));
        this.totalServiceData = this.monthlyServiceDetails.reduce((sum, data)=> sum + parseFloat(data.count), 0);
      } catch (error) {
        // console.log(error);
      }
    },
    filterMonthlyIncome(){
        this.monthLabels = this.monthlyIncomeData.map((data) => data.month);
        this.monthlyIncome = this.monthlyIncomeData.map((data) => parseFloat(data.total_income));
        this.totalIncome = this.monthlyIncomeData.reduce((sum, data)=> sum + parseFloat(data.total_income), 0);
    },
  }
};
</script>

<template>
  <CRow :xs="{ gutter: 4 }" v-if="dashBoardPermission != null">
    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="primary">
        <template #value
          >{{ customerCountData }}
        </template>
        <template #title>Total Customers <CIcon name="cil-people" /></template>
        <template #chart>
          <CChart
            type="line"
            class="mt-3 mx-3"
            style="height: 70px"
            ref="widgetChartRef1"
          />
        </template>
      </CWidgetStatsA>
    </CCol>

    <CCol :sm="6" :xl="4" :xxl="3" v-if="dashBoardPermission.add != 0 && dashBoardPermission.edit != 0 && dashBoardPermission.delete != 0">
      <CWidgetStatsA color="danger">
        <template #value
          >₹ {{ totalIncome }}
          <!-- <span class="fs-6 fw-normal"> (-23.6% <CIcon icon="cil-arrow-bottom" />) </span> -->
        </template>
        <template #title>Annual Earnings</template>
        <template #chart>
          <CChart
            type="bar"
            class="mt-3 mx-3"
            style="height: 70px"
            :data="{
              labels: monthLabels,
              datasets: [
                {
                  label: 'Income',
                  backgroundColor: 'rgba(255,255,255,.2)',
                  borderColor: 'rgba(255,255,255,.55)',
                  data: monthlyIncome,
                  barPercentage: 0.6,
                },
              ],
            }"
            :options="{
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false,
                },
              },
              scales: {
                x: {
                  grid: {
                    display: false,
                    drawTicks: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
                y: {
                  border: {
                    display: false,
                  },
                  grid: {
                    display: false,
                    drawTicks: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
              },
            }"
          />
        </template>
      </CWidgetStatsA>
    </CCol>

    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="info">
        <template #value
          >{{ totalServiceData }}
        </template>
        <template #title>Total Services Availed This Year</template>
        <template #chart>
          <CChart
            type="line"
            class="mt-3 mx-3"
            style="height: 70px"
            :data="{
              labels: monthLabelForServiceDetails,
              datasets: [
                {
                  label: 'Services',
                  backgroundColor: 'rgba(255,255,255,.2)',
                  borderColor: 'rgba(255,255,255,.55)',
                  data: monthlyServiceData,
                  barPercentage: 0.6,
                },
              ],
            }"
            :options="{
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false,
                },
              },
              scales: {
                x: {
                  grid: {
                    display: false,
                    drawTicks: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
                y: {
                  border: {
                    display: false,
                  },
                  grid: {
                    display: false,
                    drawTicks: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
              },
            }"
          />
        </template>
      </CWidgetStatsA>
    </CCol>

    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="green">
        <template #value
          >{{ servicesCompleted }}
          <!-- <span class="fs-6 fw-normal"> (40.9% <CIcon icon="cil-arrow-top" />) </span> -->
        </template>
        <template #title>Resolved Services</template>
        <template #chart>
          <CChart
            type="line"
            class="mt-3 mx-3"
            style="height: 70px"
            ref="widgetChartRef2"
          />
        </template>
      </CWidgetStatsA>
    </CCol>

    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="warning">
        <template #value
          >{{ servicesPending }}
          <!-- <span class="fs-6 fw-normal"> (40.9% <CIcon icon="cil-arrow-top" />) </span> -->
        </template>
        <template #title>Unresolved Services</template>
        <template #chart>
          <CChart
            type="line"
            class="mt-3 mx-3"
            style="height: 70px"
            ref="widgetChartRef2"
          />
        </template>
      </CWidgetStatsA>
    </CCol>
  </CRow>
</template>
