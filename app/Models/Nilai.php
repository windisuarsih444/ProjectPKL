<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Nilai extends Model
    {
        use HasFactory;

        protected $table = 'nilai';
        protected $fillable = ['student_id', 'teacher_id', 'mapel_id', 'nilai'];

        public function student()
        {
            return $this->belongsTo(Student::class, 'student_id', 'id');
        }
    

        public function teacher()
        {
            return $this->belongsTo(Teacher::class , 'teacher_id','id');
        }

        public function mapel()
        {
            return $this->belongsTo(Mapel::class ,'mapel_id','id');
        }
    }

