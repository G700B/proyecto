document.addEventListener("DOMContentLoaded", function () {
  const fechaInput = document.getElementById("fecha_turno");
  const horaInput = document.getElementById("hora_turno");

  // Bloquear domingos
  fechaInput.addEventListener("change", function () {
    const fechaSeleccionada = new Date(this.value);
    const esDomingo = fechaSeleccionada.getDay() === 0;

    if (esDomingo) {
      alert("La barbería no trabaja los domingos. Por favor, seleccioná otro día.");
      this.value = ""; // Limpia la selección
    }
  });

  // Reemplazar el input de hora por un select con intervalos cada 25 min
  if (horaInput.type === "time") {
    const select = document.createElement("select");
    select.name = "hora_turno";
    select.id = "hora_turno";
    select.classList = horaInput.classList;

    const inicio = 10 * 60; // 10:00 en minutos
    const fin = 18 * 60;    // 18:00 en minutos

    for (let i = inicio; i <= fin; i += 25) {
      const horas = Math.floor(i / 60).toString().padStart(2, "0");
      const minutos = (i % 60).toString().padStart(2, "0");
      const valor = `${horas}:${minutos}`;
      const option = document.createElement("option");
      option.value = valor;
      option.textContent = valor;
      select.appendChild(option);
    }

    horaInput.replaceWith(select);
  }
});
document.addEventListener("DOMContentLoaded", function () {
  flatpickr("#fecha_turno", {
    dateFormat: "Y-m-d",
    minDate: "today",
    disable: [
      function (date) {
        // 0 = Domingo
        return date.getDay() === 0;
      }
    ],
    locale: {
      firstDayOfWeek: 1 // Lunes como primer día
    }
  });

  const horaInput = document.getElementById("hora_turno");
  if (horaInput) {
    horaInput.setAttribute("min", "10:00");
    horaInput.setAttribute("max", "18:00");
    horaInput.setAttribute("step", "1500"); // 1500 segundos = 25 minutos
  }
});
