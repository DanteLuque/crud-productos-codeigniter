import { agregarDireccion, renderDirecciones, updateDireccion } from "./direcciones/direcciones.js";
import { loadProvincias, loadDistritos } from "./ubigeo/ubigeo.js";

// Exponemos al window para que los pueda llamar el HTML
window.agregarDireccion = agregarDireccion;
window.updateDireccion = updateDireccion;
window.loadProvincias = loadProvincias;
window.loadDistritos = loadDistritos;

// Render inicial
renderDirecciones();
