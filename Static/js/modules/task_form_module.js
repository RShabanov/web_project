"use strict";

export class Task {
    static varNames = [
        'id', 'name', 'type_id',
        'location', 'time',
        'duration', 'comment',
        'status_id', 'deleted',
    ];
    
    constructor() {
        this.id = '';
        this.name = '';
        this.type_id = '';
        this.location = '';
        this.time = '';
        this.duration = '';
        this.comment = '';
        this.status_id = '';
        this.deleted = '';
    }
}