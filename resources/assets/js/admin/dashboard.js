window.Vue = require('vue');

const dashApp = new Vue({
    el: '#dashboard-app',
    data: {
      seasons: seasonsLoaded,
      activeSeason: seasonsLoaded[0],
      activeDetails: { travelers: '', captured: '', projected: ''},
      loadChartData: {
        trips: [],
        groups: [],
        captured: [],
        projected: [],
      },
      chartScrub: 0,
      scrubLen: 5,
      groupLen: 0,
      groups: groupsLoaded,
      // Stored data
    },
    methods: {
      selectSeason(event){
        this.activeSeason = parseInt($(event.target).val());
        this.chartScrub = 0;
        this.clearActive();
        this.updateActive();
      },
      scrubRight(){
        this.chartScrub++;
        this.clearActive();
        this.updateActive();
      },
      scrubLeft(){
        this.chartScrub--;
        this.clearActive();
        this.updateActive();
      },
      clearActive(){
        this.activeDetails.travelers = 0;
        this.activeDetails.captured = 0;
        this.activeDetails.projected = 0;
        this.loadChartData = {
          trips: [],
          groups: [],
          captured: [],
          projected: [],
        };
      },
      updateActive(){
        this.groupLen = this.groups[this.activeSeason].length;
        for (let i = 0; i < this.groups[this.activeSeason].length; i++){
          this.activeDetails.travelers += this.groups[this.activeSeason][i].travelers;
          this.activeDetails.captured += this.groups[this.activeSeason][i].paid;
          this.activeDetails.projected += this.groups[this.activeSeason][i].total;
          if (i < this.scrubLen){
            this.loadChartData.trips.push(this.groups[this.activeSeason][i + this.chartScrub].travelers);
            this.loadChartData.groups.push(this.groups[this.activeSeason][i + this.chartScrub].number);
            this.loadChartData.captured.push(this.groups[this.activeSeason][i + this.chartScrub].paid/1000);
            this.loadChartData.projected.push(this.groups[this.activeSeason][i + this.chartScrub].total/1000);
          }
        }
        summaryChartData = this.loadChartData;
        this.reloadChart();
      },
      reloadChart(){
        $("#summary-chart-container").html('');
        $("#summary-chart-container").html('<canvas id="summary-chart" width="700" height="350"></canvas>');
        var summaryCfg = {
                    labels: summaryChartData.groups,
                    datasets: [{
                        label: 'Captured',
                        backgroundColor: "#7db4ce",
                        stack: 'Stack 0',
                        data: summaryChartData.captured,
                    }, {
                        label: 'Projected',
                        backgroundColor: "#aed2e2",
                        stack: 'Stack 0',
                        data: summaryChartData.projected,
                    }, {
                        label: 'Trips',
                        backgroundColor: "#e9cfb0",
                        stack: 'Stack 1',
                        data: summaryChartData.trips,
                    }]

                };
        let summaryCtx = document.getElementById("summary-chart").getContext('2d');
      	window.myBar = new Chart(summaryCtx, {
              type: 'bar',
              data: summaryCfg,
              options: {
                  title:{
                      display:false,
                      text:"Summary"
                  },
                  tooltips: {
                      enabled: true,
                      mode: 'index',
                      display: false,
                      intersect: false,
                      callbacks: {
                          label: function(tooltipItems, data) {
                            let index = tooltipItems.datasetIndex;
                            let pS = (index != 2) ? '$' : '';
                            let pK = (index != 2) ? 'k' : '';
                            return data.datasets[index].label + ': ' + pS + tooltipItems.yLabel + pK;
                          }
                      }
                  },
                  legend: {
          						display: false,
                      position: 'bottom',
                  },
                  responsive: true,
                  scales: {
                      xAxes: [{
                          stacked: true,
                          barPercentage: 0.7
                      }],
                      yAxes: [{
                          stacked: false,
                          ticks : {
                              beginAtZero : true,
                          },
                      }]
                  }
              }
          });
      }
    },
    mounted() {
      this.chartScrub = 0;
      this.clearActive();
      this.updateActive();
    },
    components: {
    },
    computed: {
      // computed data
    }
});
