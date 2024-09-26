export function lerp(t, x1, x2) {
    return x1 + (x2 - x1) * t;
}

export function lerpBezier(t, spx, spy, cp1x, cp1y, cp2x, cp2y, epx, epy) {
    let points = [
        {x: spx, y: spy},
        {x: cp1x, y: cp1y},
        {x: cp2x, y: cp2y},
        {x: epx, y: epy}
    ];

    while (points.length > 1) {
        for (var i = 0; i < points.length - 1; i++) {
            points[i].x = lerp(t, points[i].x, points[i + 1].x);
            points[i].y = lerp(t, points[i].y, points[i + 1].y);
        }

        points.pop();
    }

    return points[0];
}

export function lerpColor(t, fromCol, toCol) {
    let fromR = parseInt(fromCol.substr(1, 2), 16);
    let fromG = parseInt(fromCol.substr(3, 2), 16);
    let fromB = parseInt(fromCol.substr(5, 2), 16);

    let toR = parseInt(toCol.substr(1, 2), 16);
    let toG = parseInt(toCol.substr(3, 2), 16);
    let toB = parseInt(toCol.substr(5, 2), 16);

    function componentToHex(c) {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    let R = Math.trunc(lerp(t, fromR, toR));
    let G = Math.trunc(lerp(t, fromG, toG));
    let B = Math.trunc(lerp(t, fromB, toB));

    return `#${componentToHex(R)}${componentToHex(G)}${componentToHex(B)}`;
}
