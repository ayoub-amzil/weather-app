var time = [],temp = [];
for (let i = 0; i < 7; i++) {
    const start = i * 24;
    const end = start + 24;
    time.push(weatherData.hourly.time.slice(start, end));
    temp.push(weatherData.hourly.temperature_2m.slice(start, end));
} 
// loot through weatherData.hourly(time/temprature), and slice it's items to create 7 sub-items array, each one presents a day

var avgTempArr = [];
temp.forEach(element => {
    const avgTemp = element.reduce((a, b) => a + b, 0) / element.length; // return average temp as a intger
    avgTempArr.push(Math.round(avgTemp)) // create an array containes the average temp
});
// return average temp as a intger
// create an array containes the average temp

console.log(time)

function graph(label,wdata,i,avgTemp){ // a function to generat a graph
    // label =  name of the graph
    // wdata =  data
    // i =  to loop and keep tracking og the canvas's id
    // avgtemp = return the average temp of each day


    var color = (avgTemp < 20 ) ? '#36a2eb' : '#ff6384';
    // set the color of the graph |blue for cold weather, and red for warm/hot weather]


    const graphLabel = new Date(label[i]);
    // set the label of the graph [day mth dd yyyy]
    // convert the return of label[i] from string to Date object


    graphDset = [];
    for(let i=0;i<label.length;i++){
        let  graphD = new Date(label[i]);
        graphDset.push(graphD.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'}));
    }
    // set the data label to hh:mm format
    // loop through the set, to convert it from string to Date object
    // cut the S option from toLocaleTimeString()


    const dataGraph = { 
        labels: graphDset,
        datasets: [{
            label: graphLabel.toDateString(),
            backgroundColor: color,
            borderColor: color,
            data: wdata,
            fill: {
                target: 'origin',
                above: color+'50',   // Area will be red above the origin
            },
            pointRadius: 2,
            borderWidth	: 2,
        }]
    };
    // add data

    const config = {
        type: 'line',
        data: dataGraph,
        options: {}
    };
    // config the grapg object

    const myChart = new Chart(document.getElementById('graph'+i),config);
    // create a new graph objct for every set of data


}  // end function


for(let i=0;i<7;i++){
    graph(time[i],temp[i],i,avgTempArr[i]);
} // loop through the sub-items, 7 for 7 days


tempAvgLabs = []
for(let i=0;i<7;i++){
    let  tempAvgLab = new Date(time[i][0]);
    tempAvgLabs.push(tempAvgLab.toDateString())
}
// return full list of the days depending on the date from the data(weather.hourly.time)


const ctx = document.getElementById('graphAvg');
new Chart(ctx, {
    type: 'bar',
    data: {
      labels: tempAvgLabs,
      datasets: [{
        label: 'Average Temperature (°C)',
        data: avgTempArr,
        backgroundColor: '#4bc0c090',
        borderColor: '#4bc0c0',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
// create the average temperature graph