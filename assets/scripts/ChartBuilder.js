export default class ChartBuilder {
  constructor(canvasId = 'myChart') {
    this.ctx = document.getElementById(canvasId).getContext('2d');
    this.dataPoints = [];
  }

  build = data => {
    this.parseData(data);
    this.renderChart();
  };

  // Парсинг данных из файла
  parseData = data => {
    let counter = 0;
    let total = 0;

    this.dataPoints.labels = [];
    this.dataPoints.datasets = [{
      label: "RoboForex (CY) Ltd.",
      borderColor: "#07f",
      fill: false,
      data: [],
    }];

    for (let arr in data) {
      this.dataPoints.labels.push(counter++);
      total += parseFloat(data[arr][1]);
      total = Math.round(total * 100) / 100;
      this.dataPoints.datasets[0].data.push(total);
    }
  };

  // Построение графика
  renderChart = () => {
    this.lineChart = new Chart(this.ctx, {
      type: 'line',
      data: this.dataPoints,
    });
  }
}