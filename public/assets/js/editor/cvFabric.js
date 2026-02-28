const moldeContainer = document.getElementById('molde__container');
const canvas = document.createElement('canvas');

canvas.width = moldeContainer.clientWidth;
canvas.height = moldeContainer.clientHeight;

moldeContainer.appendChild(canvas);

const cvFabric = new fabric.Canvas(canvas);

export default cvFabric;