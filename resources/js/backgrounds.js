import {lerpColor, lerpBezier} from './math';

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
            const base_gap_points = 4;
            const base_height = 70;

            for (let i = 0; i * gap_sines + padding_top < canvas.height; i++) {
                const top = i * gap_sines + padding_top;
                const type = i % 4;

                const gap_points = base_gap_points * (type + 1);

                let j = 0;

                while (true) {
                    const phase_start = type * 3;
                    const speed_start = type / 100 + 0.5;
                    const max_height_start = base_height / (type + 4);

                    const sine_start = Math.sin(j / (4 + type / 3) + -t * speed_start + phase_start);

                    const height_start = sine_start * max_height_start;
                    const left_start = (sine_start / (Math.PI * 8) + 1) * j * (gap_points + gap_points) + padding_left;

                    const phase_end = type * 3;
                    const speed_end = type / 100 + 0.5;
                    const max_height_end = base_height;

                    const sine_end = Math.sin(j / (4 + type / 3) + -t * speed_end + phase_end);
                    const height_end = sine_end * max_height_end;

                    const left_end = (sine_end / (Math.PI * 8) + 1) * j * (gap_points + gap_points) + padding_left;

                    ctx.beginPath();

                    ctx.lineCap = "round";
                    ctx.lineWidth = 5;
                    const color = lerpColor(1 - (top / canvas.height), "#531253", "#33032F");
                    ctx.strokeStyle = color;

                    ctx.moveTo(left_start, top + height_start);
                    ctx.lineTo(left_end, top + height_end);

                    ctx.stroke();

                    if (left_end >= canvas.width + 30) {
                        break;
                    }

                    j++;
                }
            }
        }
    });
});
