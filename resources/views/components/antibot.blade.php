@php
    $componentId = 'antibot-' . Str::uuid();
@endphp

<div id="{{ $componentId }}"></div>

<input type="text" name="contact_field" value="" style="display:none">

<input type="hidden" name="form_start_time" value="{{ now()->timestamp }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const wrap = document.getElementById("{{ $componentId }}");

        if (!wrap) {
            return;
        }

        const label = document.createElement("label");
        label.style.display = "block";

        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "human_confirm";
        checkbox.required = true;

        label.appendChild(checkbox);
        label.appendChild(document.createTextNode(" Я не робот"));

        wrap.appendChild(label);

        const form = wrap.closest("form");

        if (form) {
            const startInput = form.querySelector('[name="form_start_time"]');

            if (startInput) {
                startInput.value = Date.now();
            }
        }
    });
</script>
