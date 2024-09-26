$(document).ready(function() {
    $.map($(".line-background"), function(canvas) {
        let ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        window.addEventListener('resize', resizeCanvas, false);

        resizeCanvas();

        let fps = 48;
        let interval = 1000 / fps;
        setInterval(drawCanvas, interval);

        let pointProgress = [];
        let pointProgressCoef = [];

        function drawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < 15; i++) {
                if (pointProgress.length <= i) {
                    pointProgress.push(0);
                    pointProgressCoef.push(0.05 * (i % 5 + 1) + 0.15);
                }

                let progress = pointProgress[i];
                let pointY = (i + 1) * 100;

                // Line

                ctx.beginPath();

                ctx.lineWidth = 5;
                ctx.strokeStyle = "#33032F"; 

                ctx.moveTo(0, pointY);
                let coef = pointY / 100;
                ctx.bezierCurveTo(
                    canvas.width * 1 / 3, pointY + 200 * coef * 0.5, 
                    canvas.width * 2 / 3 - 50, pointY - 100 * coef,
                    canvas.width * 3 / 3 + 100, pointY - 50 * coef * 1.2);
                ctx.stroke();

                // Circle

                ctx.beginPath();

                let {x, y} = lerpBezier(
                    progress,
                    0, pointY, 
                    canvas.width * 1 / 3, pointY + 200 * coef * 0.5,
                    canvas.width * 2 / 3 - 50, pointY - 100 * coef, 
                    canvas.width * 3 / 3 + 100, pointY - 50 * coef * 1.2);

                ctx.strokeStyle = "#531253"; 
                ctx.ellipse(x, y, 3, 3, 0, 0, Math.PI * 2);
                ctx.stroke();

                progress += interval / 1000 * pointProgressCoef[i];
                if (progress > 1) {
                    progress = 0;
                }
                pointProgress[i] = progress;
            }
        }
    });

    $.map($(".sine-background"), function(canvas) {
        let ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = $(canvas).parent().height();
        }

        window.addEventListener('resize', resizeCanvas, false);

        resizeCanvas();

        let fps = 30;
        let interval = 1000 / fps;
        let t = 0;
        setInterval(drawCanvas, interval);

        function drawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            t += interval / 1000;

            const padding_top = 100;
            const gap_sines = 170;

            const padding_left = 10;
            const gap_points = 4;
            const base_width_points = 10;
            const base_height = 70;

            for (let i = 0; i * gap_sines + padding_top < canvas.height; i++) {
                const top = i * gap_sines + padding_top;
                const type = i % 3;

                const width_points = base_width_points * (type + 1) / 2;
                for (let j = 0; j * (gap_points + width_points) + padding_left < canvas.width; j++) {
                    const left = j * (gap_points + width_points) + padding_left; 
                    const phase = type * 2;
                    const speed = type / 100 + 0.5;
                    const max_height = Math.max(base_height, base_height * (j / 100));
                    const height = Math.sin(j / (4 + type / 3) + -t * speed + phase) * max_height;

                    ctx.beginPath();

                    ctx.lineCap = "round";
                    ctx.lineWidth = 5;
                    const color = lerpColor(1 - (top / canvas.height), "#531253", "#33032F"); 
                    ctx.strokeStyle = color;

                    ctx.moveTo(left, top);
                    ctx.lineTo(left, top + height);
                        
                    ctx.stroke();
                }
            }
        }
    });
});
