$(document).ready(function() {
  $('ul.sf-menu').superfish({
    delay: 250,
    animation: {opacity:'show',height:'show'},
    speed: 'fast',
    autoArrows: false
 });
});

$(window).load(function() {
  $('#slider').nivoSlider({
    effect:'boxRain',
    slices:10,
    boxCols: 10,
    boxRows: 6,
    animSpeed:500,
    pauseTime:5000,
    controlNav:false
  });
});

$(document).ready(function() {
  var canvas = document.getElementById('logo');
  var context = canvas.getContext('2d');
  
  context.beginPath();
  context.moveTo(152, 2);
  context.lineTo(153, 2);
  context.strokeStyle = '#111111';
  context.lineWidth = 15;
  context.stroke();

  context.beginPath();
  context.moveTo(153, 2);
  context.lineTo(195, 54);
  context.strokeStyle = '#222222';
  context.lineWidth = 15;
  context.stroke();

  context.beginPath();
  context.moveTo(195, 54);
  context.lineTo(254, 54);
  context.strokeStyle = '#333333';
  context.lineWidth = 15;
  context.stroke();

  context.beginPath();
  context.moveTo(254, 54);
  context.lineTo(214, 116);
  context.strokeStyle = '#444444';
  context.lineWidth = 15;
  context.stroke();

  context.beginPath();
  context.moveTo(91, 116);
  context.lineTo(51, 54);
  context.strokeStyle = '#555555';
  context.lineWidth = 15;
  context.stroke();

  context.beginPath();
  context.moveTo(51, 54);
  context.lineTo(110, 54);
  context.strokeStyle = '#666666';
  context.lineWidth = 15;
  context.stroke();

  context.beginPath();
  context.moveTo(110, 54);
  context.lineTo(152, 2);
  context.strokeStyle = '#777777';
  context.lineWidth = 15;
  context.stroke();

  context.lineWidth = 7;
  context.font = '45pt Calibri';
  context.strokeStyle = 'Gray';
  context.strokeText('M', 112, 108);
  context.strokeText('P', 162, 138);
});