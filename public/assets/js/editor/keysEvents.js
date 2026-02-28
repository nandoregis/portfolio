import { canvasLimit, deleteImgFromTexture, textureGenerator } from "./config.js";
import cvFabric from "./cvFabric.js";

const actionEnter = (e) => {textureGenerator();}
const actionDelete = (e) => {deleteImgFromTexture();}

const actionArrowLeft = () => {
    let obj =  cvFabric.getActiveObject();
    if(obj) obj.left -= 5;
    canvasLimit(obj);
    cvFabric.renderAll();
}

const actionArrowRight = () => {
    let obj =  cvFabric.getActiveObject();
    if(obj) obj.left += 5;
    canvasLimit(obj);
    cvFabric.renderAll();
}

const actionArrowTop = () => {
    let obj =  cvFabric.getActiveObject();
    if(obj) obj.top -= 5;
    canvasLimit(obj);
    cvFabric.renderAll();
}

const actionArrowDown = () => {
    let obj =  cvFabric.getActiveObject();
    if(obj) obj.top += 5;
    canvasLimit(obj);
    cvFabric.renderAll();

}


const keyCodeList = [
    {code: 13, key: 'Enter', action: actionEnter},
    {code: 46, key: 'Delete', action: actionDelete},
    {code: 37, key: 'ArrowLeft', action: actionArrowLeft},
    {code: 38, key: 'ArrowTop', action: actionArrowTop},
    {code: 39, key: 'ArrowRight', action: actionArrowRight},
    {code: 40, key: 'ArrowDown', action: actionArrowDown}
];

export const pressedKey = (e) => 
{
    return keyCodeList.filter( (key) => { return e.keyCode === key.code;})[0];
}

