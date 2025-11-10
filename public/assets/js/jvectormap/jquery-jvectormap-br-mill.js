// Mapa do Brasil - jVectorMap
// Este arquivo define o mapa br_mill
// Quando carregado, adiciona o namespace jvm.maps

window.jvm = window.jvm || {};
window.jvm.maps = window.jvm.maps || {};

// Definir o mapa do Brasil
window.jvm.maps.br_mill = {
    width: 1000,
    height: 1000,
    paths: {
        'BR-AC': { name: 'Acre' },
        'BR-AL': { name: 'Alagoas' },
        'BR-AP': { name: 'Amapá' },
        'BR-AM': { name: 'Amazonas' },
        'BR-BA': { name: 'Bahia' },
        'BR-CE': { name: 'Ceará' },
        'BR-DF': { name: 'Distrito Federal' },
        'BR-ES': { name: 'Espírito Santo' },
        'BR-GO': { name: 'Goiás' },
        'BR-MA': { name: 'Maranhão' },
        'BR-MT': { name: 'Mato Grosso' },
        'BR-MS': { name: 'Mato Grosso do Sul' },
        'BR-MG': { name: 'Minas Gerais' },
        'BR-PA': { name: 'Pará' },
        'BR-PB': { name: 'Paraíba' },
        'BR-PR': { name: 'Paraná' },
        'BR-PE': { name: 'Pernambuco' },
        'BR-PI': { name: 'Piauí' },
        'BR-RJ': { name: 'Rio de Janeiro' },
        'BR-RN': { name: 'Rio Grande do Norte' },
        'BR-RS': { name: 'Rio Grande do Sul' },
        'BR-RO': { name: 'Rondônia' },
        'BR-RR': { name: 'Roraima' },
        'BR-SC': { name: 'Santa Catarina' },
        'BR-SP': { name: 'São Paulo' },
        'BR-SE': { name: 'Sergipe' },
        'BR-TO': { name: 'Tocantins' }
    }
};

// Marcar como carregado
window.jvm.WorldMap = window.jvm.WorldMap || {};

console.log('✓ Mapa br_mill carregado');