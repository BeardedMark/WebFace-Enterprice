<div id="antibot-check"></div>

{{-- honeypot (скрытое поле, видят только боты) --}}
<input type="text" name="contact_field" value="" style="display:none">

{{-- поле для времени заполнения --}}
<input type="hidden" name="form_start_time" id="form-start-time" value="{{ now()->timestamp }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // вставляем чекбокс только через JS
        const wrap = document.getElementById("antibot-check");
        if (wrap) {
            const label = document.createElement("label");
            label.style.display = "block";

            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "human_confirm";
            checkbox.required = true;

            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(" Я не робот"));
            wrap.appendChild(label);
        }

        // фиксируем момент открытия формы
        const startInput = document.getElementById("form-start-time");
        startInput.value = Date.now(); // JS timestamp в миллисекундах
    });
</script>
