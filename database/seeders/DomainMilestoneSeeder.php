<?php

namespace Database\Seeders;

use App\Models\DomainMilestone;
use Illuminate\Database\Seeder;

class DomainMilestoneSeeder extends Seeder
{
    // icon slugs are passed to the Flutter app for asset/icon lookup
    private array $milestones = [
        'reading' => [
            [
                'threshold'         => 20,
                'name'              => 'Primer lector',
                'description'       => 'Ya estás dando tus primeros pasos para entender mejor lo que lees.',
                'sort_order'        => 1,
                'icon'              => 'book-open',
                'reward_xp'         => 10,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 40,
                'name'              => 'Explorador de lectura',
                'description'       => 'Sigues descubriendo pistas importantes en los textos. ¡Sigue avanzando!',
                'sort_order'        => 2,
                'icon'              => 'compass',
                'reward_xp'         => 15,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 60,
                'name'              => 'Navegante lector',
                'description'       => 'Estás comprendiendo mejor las ideas principales y los detalles importantes.',
                'sort_order'        => 3,
                'icon'              => 'map',
                'reward_xp'         => 25,
                'celebration_level' => 'medium',
            ],
            [
                'threshold'         => 80,
                'name'              => 'Guía lector',
                'description'       => 'Lees con más seguridad y entiendes mejor lo que un texto quiere decir.',
                'sort_order'        => 4,
                'icon'              => 'star',
                'reward_xp'         => 40,
                'celebration_level' => 'big',
            ],
            [
                'threshold'         => 95,
                'name'              => 'Maestro lector',
                'description'       => 'Has alcanzado un nivel muy alto de comprensión lectora. ¡Excelente trabajo!',
                'sort_order'        => 5,
                'icon'              => 'trophy',
                'reward_xp'         => 60,
                'celebration_level' => 'big',
            ],
        ],
        'attention' => [
            [
                'threshold'         => 20,
                'name'              => 'Primer enfoque',
                'description'       => 'Ya estás empezando a concentrarte mejor en las actividades.',
                'sort_order'        => 1,
                'icon'              => 'eye',
                'reward_xp'         => 10,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 40,
                'name'              => 'Explorador de enfoque',
                'description'       => 'Tu atención está creciendo. Cada vez detectas mejor lo importante.',
                'sort_order'        => 2,
                'icon'              => 'compass',
                'reward_xp'         => 15,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 60,
                'name'              => 'Guardián de atención',
                'description'       => 'Tu enfoque mejora mucho y te ayuda a resolver actividades con más cuidado.',
                'sort_order'        => 3,
                'icon'              => 'shield',
                'reward_xp'         => 25,
                'celebration_level' => 'medium',
            ],
            [
                'threshold'         => 80,
                'name'              => 'Centinela del enfoque',
                'description'       => 'Mantienes la atención con mucha más fuerza y control.',
                'sort_order'        => 4,
                'icon'              => 'zap',
                'reward_xp'         => 40,
                'celebration_level' => 'big',
            ],
            [
                'threshold'         => 95,
                'name'              => 'Maestro de atención',
                'description'       => 'Has desarrollado un gran dominio del enfoque y la atención.',
                'sort_order'        => 5,
                'icon'              => 'trophy',
                'reward_xp'         => 60,
                'celebration_level' => 'big',
            ],
        ],
        'reasoning' => [
            [
                'threshold'         => 20,
                'name'              => 'Primer pensador',
                'description'       => 'Ya estás comenzando a resolver problemas con más lógica.',
                'sort_order'        => 1,
                'icon'              => 'lightbulb',
                'reward_xp'         => 10,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 40,
                'name'              => 'Explorador lógico',
                'description'       => 'Sigues desarrollando tu razonamiento paso a paso.',
                'sort_order'        => 2,
                'icon'              => 'compass',
                'reward_xp'         => 15,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 60,
                'name'              => 'Navegante lógico',
                'description'       => 'Tus decisiones y conclusiones muestran un pensamiento más fuerte.',
                'sort_order'        => 3,
                'icon'              => 'map',
                'reward_xp'         => 25,
                'celebration_level' => 'medium',
            ],
            [
                'threshold'         => 80,
                'name'              => 'Estratega lógico',
                'description'       => 'Resuelves problemas con más claridad y mejores decisiones.',
                'sort_order'        => 4,
                'icon'              => 'target',
                'reward_xp'         => 40,
                'celebration_level' => 'big',
            ],
            [
                'threshold'         => 95,
                'name'              => 'Maestro del razonamiento',
                'description'       => 'Has alcanzado un nivel muy alto de pensamiento lógico y crítico.',
                'sort_order'        => 5,
                'icon'              => 'trophy',
                'reward_xp'         => 60,
                'celebration_level' => 'big',
            ],
        ],
        'math' => [
            [
                'threshold'         => 20,
                'name'              => 'Primer matemático',
                'description'       => 'Ya estás dando tus primeros pasos en el pensamiento matemático.',
                'sort_order'        => 1,
                'icon'              => 'calculator',
                'reward_xp'         => 10,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 40,
                'name'              => 'Explorador matemático',
                'description'       => 'Sigues descubriendo patrones, cantidades y relaciones numéricas.',
                'sort_order'        => 2,
                'icon'              => 'compass',
                'reward_xp'         => 15,
                'celebration_level' => 'small',
            ],
            [
                'threshold'         => 60,
                'name'              => 'Navegante matemático',
                'description'       => 'Comprendes mejor los números y resuelves situaciones con más seguridad.',
                'sort_order'        => 3,
                'icon'              => 'chart-bar',
                'reward_xp'         => 25,
                'celebration_level' => 'medium',
            ],
            [
                'threshold'         => 80,
                'name'              => 'Estratega matemático',
                'description'       => 'Tu pensamiento matemático es cada vez más sólido y flexible.',
                'sort_order'        => 4,
                'icon'              => 'target',
                'reward_xp'         => 40,
                'celebration_level' => 'big',
            ],
            [
                'threshold'         => 95,
                'name'              => 'Maestro matemático',
                'description'       => 'Has alcanzado un dominio muy alto del razonamiento matemático.',
                'sort_order'        => 5,
                'icon'              => 'trophy',
                'reward_xp'         => 60,
                'celebration_level' => 'big',
            ],
        ],
    ];

    public function run(): void
    {
        foreach ($this->milestones as $domainId => $ladder) {
            foreach ($ladder as $data) {
                DomainMilestone::updateOrCreate(
                    ['domain_id' => $domainId, 'threshold' => $data['threshold']],
                    array_merge($data, ['domain_id' => $domainId, 'is_hidden' => false])
                );
            }
        }
    }
}
