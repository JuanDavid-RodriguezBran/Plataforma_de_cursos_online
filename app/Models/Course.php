<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Course
 *
 * Representa un curso dentro de la plataforma.
 * Cada curso pertenece a una sección y a un profesor (usuario),
 * y opcionalmente puede tener un curso prerequisito.
 *
 * @property int $course_id
 * @property string $title
 * @property string|null $description
 * @property int $section_id
 * @property int $user_id
 * @property int|null $prerequisite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\User $professor
 * @property-read \App\Models\Course|null $prerequisite
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $dependentCourses
 */
class Course extends Model
{
    /** @var string Nombre de la clave primaria */
    protected $primaryKey = 'course_id';

    /** @var bool Indica si la PK es autoincremental */
    protected $incrementing = true;

    /** @var string Tipo de la PK (int o string) */
    protected $keyType = 'int';

    /** @var array Campos que se pueden asignar masivamente */
    protected $fillable = [
        'title',
        'description',
        'section_id',
        'user_id',
        'prerequisite_id',
    ];

    /** @var bool Usa las columnas created_at y updated_at */
    public $timestamps = true;

    /**
     * Relación: Un curso pertenece a una sección.
     *
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Relación: Un curso pertenece a un profesor (usuario).
     *
     * @return BelongsTo
     */
    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Un curso puede tener un curso prerequisito.
     *
     * @return BelongsTo
     */
    public function prerequisite(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'prerequisite_id');
    }

    /**
     * Relación: Un curso puede ser prerequisito de otros cursos.
     *
     * @return HasMany
     */
    public function dependentCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'prerequisite_id');
    }
}
