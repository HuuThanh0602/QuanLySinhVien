<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use App\Models\Result;

class ResultsImport implements ToCollection, WithChunkReading
{
    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'student_id' => $row[0],
                'subject_id' => $row[1],
                'score' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($data as $record) {
            Result::where('student_id', $record['student_id'])
                ->where('subject_id', $record['subject_id'])
                ->update(['score' => $record['score'], 'updated_at' => now()]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
