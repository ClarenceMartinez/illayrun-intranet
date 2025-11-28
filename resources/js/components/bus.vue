<template>
    <div>
        <table class="table" v-for="(floor, index) in floors" :key="'floor_'+index">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">Piso {{ index + 1 }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(rows, j) in floor" :key="'row_'+j">
                    <td style="width: 20%" class="text-center" v-for="(asiento, k) in rows" :key="'col_'+k">
                        <div v-if="asiento.numero > 0" style="width: 50px">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 215.6 235.1" x="0px" y="0px" style="enable-background:new 0 0 215.6 235.1;" xml:space="preserve"><path class="cls-1" :style="{fill: '#000000'}" d="M199.5,75.1l-0.7-47l-2.5-2.3c-6.9-7-14.9-13-23.5-17.7C158,0.8,119.3,0,103.4,0 C92.7,0,61.5,1,45.9,5.5C35.1,8.6,25.1,16.4,16.2,28.7l-0.6,0.8v45.7C6.6,76.7,0,84.4,0,93.5v98.2c0,8.7,6,16.2,14.4,18.1 c-0.1,0.7-0.1,1.4-0.1,2.1c0,12.9,10.5,23.4,23.4,23.4h139.9c12.9,0,23.4-10.5,23.4-23.4c0,0,0,0,0,0c0-0.7,0-1.4-0.1-2.1 c8.4-1.9,14.4-9.5,14.4-18.1V93.5C215.4,84.3,208.6,76.5,199.5,75.1 M21.8,31.5c8-10.7,16.7-17.4,25.8-20.1 c13.2-3.8,41.2-5.2,55.8-5.2c12.1,0,52.7,0.5,66.7,7.5c8.1,4.5,15.5,10.1,22,16.7l0.5,0.5l0.7,44.4c-8.8,1.7-15.1,9.3-15.1,18.3 v95.1h-141V93.5c0-9-6.5-16.8-15.4-18.3L21.8,31.5z M6.2,191.7V93.5c-0.2-6.8,5.2-12.6,12-12.7S30.8,86,31,92.8c0,0.2,0,0.5,0,0.7 v96.1c-7,2.1-12.6,7.4-15.2,14.2C10.2,202.5,6.2,197.5,6.2,191.7 M177.7,229.2h-140c-9.5,0-17.2-7.7-17.2-17.1c0-0.6,0-1.2,0.1-1.8 c0.6-5.8,4.1-10.9,9.3-13.5c2.2-1.1,4.6-1.7,7-1.8c0.3,0,0.5,0,0.8,0h139.9c0.3,0,0.5,0,0.8,0c2.4,0.1,4.8,0.7,7,1.8 c2.9,1.5,5.4,3.8,7.1,6.6l0,0c1.2,2.1,2,4.4,2.2,6.8c0,0.6,0.1,1.2,0.1,1.8C194.9,221.5,187.2,229.2,177.7,229.2 C177.7,229.2,177.7,229.2,177.7,229.2 M209.2,191.7c0,5.8-4,10.8-9.6,12.1c-2.6-6.8-8.2-12.1-15.2-14.2V93.5 c0-6.8,5.6-12.4,12.4-12.4c6.8,0,12.4,5.6,12.4,12.4L209.2,191.7z" transform="translate(0 0)"/><g id="CD2" style="isolation:isolate"><text style="font-size:62.81px;font-family:Arial-BoldMT, Arial;font-weight:700;isolation:isolate;" :style="{fill: '#000000'}" transform="translate(90 130)">{{ asiento.numero }}</text></g></svg>
                        </div>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: ['asientos'],
    data(){
        return {
            floors: []
        }
    },
    watch: {
        asientos: {
            handler: function(newVal, oldVal){
                console.log('estructurar...');
                this.estructurar();
            },
            deep: true
        }
    },
    setup() {
        
    },
    methods: {
        estructurar(){
            this.floors = [];
            var r = []
                , s = []
                , a = []
                , u = [];
            if (null != this.asientos) {
                for (var d = 0; d < this.asientos.length; d++)
                    0 == this.asientos[d].piso && r.push(this.asientos[d]),
                    1 == this.asientos[d].piso && a.push(this.asientos[d])
            }

            var p = 0;
            0 != r.length && (p = Math.max.apply(Math, r.map(function(ye) {
                return ye.fila
            })));
            var _ = 0;
            0 != a.length && (_ = Math.max.apply(Math, a.map(function(ye) {
                return ye.fila
            })));
            var m = []
                , g = []
                , b = []
                , C = []
                , y = []
                , A = [];
            if (0 <= p)
                for (d = 0; d <= p; d++) {
                    s = [];
                    for (var w = 0; w < r.length; w++)
                        r[w].fila == d && s.push(r[w]);
                    m.push(s)
                }
            if (0 <= _)
                for (d = 0; d <= _; d++) {
                    for (u = [],
                    w = 0; w < a.length; w++)
                        a[w].fila == d && u.push(a[w]);
                    C.push(u)
                }

            for (d = 0; d < m.length; d++) {
                var S = [0, 1, 2, 3, 4];
                g = [];
                var j = "";
                m[d][0] && g.push(m[d][0]);
                var T = S.indexOf(m[d][0].columna);
                S.splice(T, 1)
                m[d][1] && (g.push(m[d][1]),
                T = S.indexOf(m[d][1].columna),
                S.splice(T, 1)),
                m[d][2] && (g.push(m[d][2]),
                T = S.indexOf(m[d][2].columna),
                S.splice(T, 1)),
                m[d][3] && (g.push(m[d][3]),
                T = S.indexOf(m[d][3].columna),
                S.splice(T, 1)),
                m[d][4] && (g.push(m[d][4]),
                T = S.indexOf(m[d][4].columna),
                S.splice(T, 1));
                for (var Z = 0; Z < S.length; Z++)
                    g.push({
                        id: 0,
                        numero: 0,
                        columna: S[Z],
                        fila: d,
                        piso: 0
                    });

                g.sort((re,Fe)=>re.columna - Fe.columna),
                b.push(g)
            }
            for (d = 0; d < C.length; d++) {
                for (S = [0, 1, 2, 3, 4],
                y = [],
                C[d][0] && (y.push(C[d][0]),
                T = S.indexOf(C[d][0].columna),
                S.splice(T, 1)),
                C[d][1] && (y.push(C[d][1]),
                T = S.indexOf(C[d][1].columna),
                S.splice(T, 1)),
                C[d][2] && (y.push(C[d][2]),
                T = S.indexOf(C[d][2].columna),
                S.splice(T, 1)),
                C[d][3] && (y.push(C[d][3]),
                T = S.indexOf(C[d][3].columna),
                S.splice(T, 1)),
                C[d][4] && (y.push(C[d][4]),
                T = S.indexOf(C[d][4].columna),
                S.splice(T, 1)),
                Z = 0; Z < S.length; Z++)
                    y.push({
                        id: 0,
                        numero: 0,
                        columna: S[Z],
                        fila: d,
                        piso: 0
                    });
                y.sort((Fe,Ot)=>Fe.columna - Ot.columna),
                A.push(y)
            }
            0 != b.length && this.floors.push(b),
            0 != A.length && this.floors.push(A)
        }
    }
}
</script>