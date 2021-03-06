<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Project
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Receive[] $projects
 * @property integer $id
 * @property string $code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Project extends Model
{
    protected $fillable = [
    	'code',
    ];

    public function projects()
    {
    	return $this->hasMany(Receive::class, 'project_id', 'id');
    }

    public static function deleteByCondition($id)
    {
    	$query = self::with([
    			'projects',
    		])
    		->where('id', $id)
    		->first();

    	if($query->projects()->count())
			return [
				'status' => false,
				'title' => trans('project.label.name'),
				'message' => trans('project.message_alert.delete_unsuccess'),
			];

		$response = $query->delete();

		return [
			'status' => $response,
			'title' => trans('project.label.name'),
			'message' => trans('project.message_alert.delete_success'),
		];
    }
}
