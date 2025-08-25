import { loadDepartamentos } from "../ubigeo/ubigeo.js";

let direcciones = JSON.parse(localStorage.getItem("direcciones")) || [];

export function agregarDireccion() {
  const nueva = {
    departamento: "",
    provincia: "",
    distrito: "",
    ubigeo: "",
    direccion: "",
    referencia: "",
    lat: null,
    lng: null,
  };
  direcciones.push(nueva);
  localStorage.setItem("direcciones", JSON.stringify(direcciones));
  renderDirecciones();
}

export function updateDireccion(index, field, value) {
  direcciones[index][field] = value;
  localStorage.setItem("direcciones", JSON.stringify(direcciones));
}

export function renderDirecciones() {
  const container = document.getElementById("direcciones-container");
  container.innerHTML = "";
  direcciones.forEach((dir, index) => {
    container.innerHTML += `
      <div class="border p-3 mb-3">
        <div class="row mb-2">
          <div class="col-md-4">
            <label>Departamento</label>
            <select class="form-select" id="departamento-${index}" onchange="loadProvincias(${index})">
              <option value="">Seleccione</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Provincia</label>
            <select class="form-select" id="provincia-${index}" onchange="loadDistritos(${index})">
              <option value="">Seleccione</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Distrito</label>
            <select class="form-select" id="distrito-${index}" 
              onchange="updateDireccion(${index}, 'ubigeo', this.value)">
              <option value="">Seleccione</option>
            </select>
          </div>
        </div>
        <div class="mb-2">
          <label>Dirección</label>
          <input type="text" class="form-control" value="${dir.direccion || ''}"
            onchange="updateDireccion(${index}, 'direccion', this.value)">
        </div>
        <div class="mb-2">
          <label>Referencia</label>
          <input type="text" class="form-control" value="${dir.referencia || ''}"
            onchange="updateDireccion(${index}, 'referencia', this.value)">
        </div>
        <div class="row">
          <div class="col-md-6 mb-2">
            <label>Latitud</label>
            <input type="text" class="form-control" value="${dir.lat || ''}"
              onchange="updateDireccion(${index}, 'lat', this.value)">
          </div>
          <div class="col-md-6 mb-2">
            <label>Longitud</label>
            <input type="text" class="form-control" value="${dir.lng || ''}"
              onchange="updateDireccion(${index}, 'lng', this.value)">
          </div>
        </div>
      </div>
    `;
    // 👉 Aquí llamamos a la función importada de ubigeo.js
    loadDepartamentos(index, dir.departamento, dir.provincia, dir.ubigeo);
  });
}

// Exportamos el array para depuración si lo necesitas
export { direcciones };
