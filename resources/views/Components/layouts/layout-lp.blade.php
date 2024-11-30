<x-heads.head></x-heads.head>

<style>
    body {
        background-image: linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px),
            linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px);
        background-size: 120px 120px;
        background-position: center;
    }

    .underline-secondary {
        text-decoration: underline;
        text-decoration-color: #03DAC6;
    }

    .underline-primary {
        text-decoration: underline;
        text-decoration-color: #BB86FC;
    }
</style>

<body class="bg-bg_black w-9/12 mx-auto">
    {{ $slot }}
</body>

</html>

<!-- <script>
    const section = document.getElementById('hover-section');

    document.addEventListener('mousemove', (e) => {
        const x = (window.innerWidth - e.pageX) / 480;
        const y = (window.innerHeight - e.pageY) / 480;

        section.style.transform = `translate(${x}px, ${y}px)`;
        section.style.transition = 'transform 0.1s ease-out';
    });
</script> -->