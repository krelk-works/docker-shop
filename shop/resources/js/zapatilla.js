/*
import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const shoeModel = document.getElementById('zapatilla-3d');
if (shoeModel) {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();

    renderer.setSize(shoeModel.clientWidth, shoeModel.clientHeight);
    shoeModel.appendChild(renderer.domElement);

    // Luz
    const light = new THREE.AmbientLight(0xffffff, 1);
    scene.add(light);

    // Cargar modelo dinámico desde Laravel
    const modelPath = shoeModel.getAttribute('data-model'); // Ruta del modelo desde Blade
    const loader = new GLTFLoader();
    loader.load(modelPath, function (gltf) {
        scene.add(gltf.scene);
        gltf.scene.position.set(0, 0, 0);
    }, undefined, function (error) {
        console.error('Error al cargar el modelo:', error);
    });

    // Posición de la cámara
    camera.position.z = 5;

    // Animación
    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }
    animate();
}
*/