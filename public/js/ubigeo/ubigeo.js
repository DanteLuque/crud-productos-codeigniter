export async function loadDepartamentos(index, selectedDep = '', selectedProv = '', selectedDist = '') {
    const depSelect = document.getElementById(`departamento-${index}`);
    depSelect.innerHTML = "<option value=''>Seleccione</option>";

    const res = await fetch("/ubigeo/departamentos");
    const data = await res.json();
    data.forEach(dep => {
        depSelect.innerHTML += `<option value="${dep.id}" ${dep.id == selectedDep ? "selected" : ""}>${dep.name}</option>`;
    });
    if (selectedDep) await loadProvincias(index, selectedProv, selectedDist);
}

export async function loadProvincias(index, selectedProv = '', selectedDist = '') {
    const depId = document.getElementById(`departamento-${index}`).value;
    const provSelect = document.getElementById(`provincia-${index}`);
    const distSelect = document.getElementById(`distrito-${index}`);

    provSelect.innerHTML = "<option value=''>Seleccione</option>";
    distSelect.innerHTML = "<option value=''>Seleccione</option>";

    if (!depId) return;

    const res = await fetch(`/ubigeo/provincias/${depId}`);
    const data = await res.json();
    data.forEach(prov => {
        provSelect.innerHTML += `<option value="${prov.id}" ${prov.id == selectedProv ? "selected" : ""}>${prov.name}</option>`;
    });
    if (selectedProv) await loadDistritos(index, selectedDist);
}

export async function loadDistritos(index, selectedDist = '') {
    const provId = document.getElementById(`provincia-${index}`).value;
    const distSelect = document.getElementById(`distrito-${index}`);
    distSelect.innerHTML = "<option value=''>Seleccione</option>";

    if (!provId) return;

    const res = await fetch(`/ubigeo/distritos/${provId}`);
    const data = await res.json();
    data.forEach(dist => {
        distSelect.innerHTML += `<option value="${dist.id}" ${dist.id == selectedDist ? "selected" : ""}>${dist.name}</option>`;
    });
}
