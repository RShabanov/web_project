"use strict";

export class TimeRange {
    // lowerBound <= value < upperBound
    constructor(rangeKey, date) {
        this.set(rangeKey, date);
    }

    set(rangeKey, date) {
        if (date ?? true) {
            this.lowerBound = new Date();
            this.upperBound = new Date();
        } else {
            this.lowerBound = new Date(date);
            this.upperBound = new Date(date);
        }

        this.resetTime();

        switch (rangeKey ?? 'today') {
            case 'today':
                this.setBounds('day');
                break;
            case 'tomorrow':
                this.setBounds('day');
                this.shift(1);
                break;
            case 'current_week':
                this.setBounds('week');
                break;
            case 'next_week':
                this.setBounds('week');
                this.shift(7);
                break;
        }
    }

    resetTime() {
        this.lowerBound.setHours(0, 0, 0, 0);    
        this.upperBound.setHours(0, 0, 0, 0);    
    }

    setBounds(dateKey) {
        switch (dateKey) {
            case 'day':
                this.upperBound.setDate(this.upperBound.getDate() + 1);
                break;
            case 'week':
                this.lowerBound.setDate(this.lowerBound.getDate() - this.lowerBound.getDay() + 1);
                this.upperBound.setDate(this.upperBound.getDate() + 8 - this.upperBound.getDay());
                break;
        }
    }

    shift(days) {
        this.lowerBound.setDate(this.lowerBound.getDate() + days);
        this.upperBound.setDate(this.upperBound.getDate() + days);
    }

    contains(date) {
        const tempDate = new Date(date);
        return this.lowerBound <= tempDate && tempDate < this.upperBound;
    }
};