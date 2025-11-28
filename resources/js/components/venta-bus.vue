<template>
    <div class="row">
        <div class="col-12 position-relative">
            <img src="/images/bus.svg" class="img-fluid">
            <div v-for="(piso, index) in this.estructura_final" :key="'piso_' + index" :class="'piso'+index+'_container'">
                <div v-for="(fila, findex) in piso" :key="'piso_' + index + '_row_' + findex" class="piso_row">
                    <div v-for="(col, cindex) in fila" :key="'piso_' + index + '_row_' + findex + '_col_' + cindex">
                        <v-venta-asiento v-if="col.numero > 0" :asiento="col"></v-venta-asiento>
                        <div style="height: 30px" v-if="col.numero < 1">&nbsp;</div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['itinerario', 'asientos'],
    data(){
        return {
            estructura_final: []
        }
    },
    watch: {
        /*
        itinerario: function(newVal, oldVal){
            if(newVal.id > 0)
                this.getAsientos();
        },*/
        asientos: function(newVal, oldVal){
            if(newVal.length > 0)
                this.estructurarBus(newVal);
        }
    },
    methods: {
        getAsientos(){
            axios.get('/itinerario/' + this.itinerario.id + '/asientos').then(response=>{
                var r = []
                    , s = []
                    , a = []
                    , u = [];
                if (null != response.data) {
                    for (var d = 0; d < response.data.length; d++)
                        0 == response.data[d].piso && r.push(response.data[d]),
                        1 == response.data[d].piso && a.push(response.data[d])
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
                            numero: 0,
                            columna: S[Z],
                            estado_asiento: 0,
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
                            numero: 0,
                            columna: S[Z],
                            estado_asiento: 0,
                            fila: d,
                            piso: 0
                        });
                    y.sort((Fe,Ot)=>Fe.columna - Ot.columna),
                    A.push(y)
                }
                0 != b.length && this.estructura_final.push(b),
                0 != A.length && this.estructura_final.push(A)
            });
        },
        estructurarBus(asientos){
            this.estructura_final = [];
            var r = []
                , s = []
                , a = []
                , u = [];
            if (null != asientos) {
                for (var d = 0; d < asientos.length; d++)
                    0 == asientos[d].piso && r.push(asientos[d]),
                    1 == asientos[d].piso && a.push(asientos[d])
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
                        numero: 0,
                        columna: S[Z],
                        estado_asiento: 0,
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
                        numero: 0,
                        columna: S[Z],
                        estado_asiento: 0,
                        fila: d,
                        piso: 0
                    });
                y.sort((Fe,Ot)=>Fe.columna - Ot.columna),
                A.push(y)
            }
            0 != b.length && this.estructura_final.push(b),
            0 != A.length && this.estructura_final.push(A)
        }
    }
}
</script>