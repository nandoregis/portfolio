import * as THREE from '../build/three.module.js';
import {OrbitControls} from '../jsm/OrbitControls.js';

export default class Controls
{   
    #controls;
    target
    constructor(camera, dom) {
        this.#controls = new OrbitControls(camera, dom);
        this.#controls.enableDamping = true;
        this.#controls.dampingFactor = 0.05;

        this.#controls.enabled = true;
        this.#controls.autoRotateSpeed = 2;

        this.target = this.#controls.target;

        // console.log(this.#controls)

    }

    off () { this.#controls.enabled = false;}
    on() { this.#controls.enabled = true;}

    scrollMin(value) { this.#controls.minDistance = value;}
    scrollMax(value) { this.#controls.maxDistance = value;}

    moveOff() {}
    moveOn() {}

    rotation (bool) {
        this.#controls.autoRotate = bool;
    }

    update() {
        this.#controls.update();
    }

    
    
}