<!-- resources/views/components/odata-ping.blade.php -->
<p id="enterprice-connection-ping-time" class="font-lg font-bold">Серверное подключение...</p>

<script>
    async function pingOData() {

        let serverPingResult;
        let clientPingResult;

        try {
            const serverStart = performance.now();
            const response = await fetch("{{ route('enterprice.ping') }}");
            const json = await response.json();
            const time = (performance.now() - serverStart).toFixed(1);

            if (json.status !== 'ok' || json.time < 50) {
                serverPingResult = 'Offline';
            } else {
                serverPingResult = `${json.time} ms`;
            }
            document.getElementById('enterprice-connection-ping-time').innerText = serverPingResult;
        } catch (e) {}
    }

    // Пингуем раз в 10 сек
    pingOData();
    setInterval(pingOData, 2000);
</script>
