export async function loadDepartamentos() {
    const depSelect = document.getElementById("departamento");
    depSelect.innerHTML = "<option value=''>Seleccione</option>";

    const res = await fetch("/ubigeo/departamentos");
    const data = await res.json();

    data.forEach(dep => {
        depSelect.innerHTML += `<option value="${dep.id}">${dep.name}</option>`;
    });
}

export async function loadProvincias() {
    const depId = document.getElementById("departamento").value;
    const provSelect = document.getElementById("provincia");
    const distSelect = document.getElementById("distrito");

    provSelect.innerHTML = "<option value=''>Seleccione</option>";
    distSelect.innerHTML = "<option value=''>Seleccione</option>";

    if (!depId) return;

    const res = await fetch(`/ubigeo/provincias/${depId}`);
    const data = await res.json();

    data.forEach(prov => {
        provSelect.innerHTML += `<option value="${prov.id}">${prov.name}</option>`;
    });
}

export async function loadDistritos() {
    const provId = document.getElementById("provincia").value;
    const distSelect = document.getElementById("distrito");

    distSelect.innerHTML = "<option value=''>Seleccione</option>";

    if (!provId) return;

    const res = await fetch(`/ubigeo/distritos/${provId}`);
    const data = await res.json();

    data.forEach(dist => {
        distSelect.innerHTML += `<option value="${dist.id}">${dist.name}</option>`;
    });
}

// Al cargar la página, inicializamos los departamentos
document.addEventListener("DOMContentLoaded", () => {
    loadDepartamentos();
});

// Exponer funciones para usarlas en el HTML inline
window.loadProvincias = loadProvincias;
window.loadDistritos = loadDistritos;
