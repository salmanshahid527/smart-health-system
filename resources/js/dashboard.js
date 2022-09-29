import Chart from 'chart.js/auto';

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];

const data = {
    labels: labels,
    datasets: [{
        label: 'Ever User',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {}
};

new Chart(
    document.getElementById('myChart'),
    config
);



const data1 = {
    labels: labels,
    datasets: [{
        label: 'Never User',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 100, 50, 20, 200, 300, 450],
    }]
};


const data2 = {
    labels: labels,
    datasets: [{
        label: 'User use methods',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 3, 5, 2, 2, 3, 4],
    }]
};

const data3 = {
    labels: labels,
    datasets: [{
        label: 'User without methods',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 100, 50, 20, 200, 300, 450],
    }]
};


const config1 = {
    type: 'line',
    data: data2,
    options: {}
};


const config2 = {
    type: 'line',
    data: data2,
    options: {}
};


const config3 = {
    type: 'line',
    data: data3,
    options: {}
};


new Chart(
    document.getElementById('myChart1'),
    config1
);

new Chart(
    document.getElementById('myChart2'),
    config2
);

new Chart(
    document.getElementById('myChart3'),
    config3
);