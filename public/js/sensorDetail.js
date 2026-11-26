/**
 * Filtering, sorting and live statistics of measurements on the sensor detail page.
 */

/**
 * One measurement, represented by its table row.
 */
class Measurement {
    constructor(row) {
        this.row = row;
        this.time = row.dataset.time; // "YYYY-MM-DD HH:MM:SS"
        this.value = Number(row.dataset.value);
    }

    get date() {
        return this.time.slice(0, 10);
    }

    /**
     * Empty filter fields do not limit the result.
     */
    matches(filter) {
        if (filter.from !== '' && this.date < filter.from) {
            return false;
        }
        if (filter.to !== '' && this.date > filter.to) {
            return false;
        }
        if (filter.min !== null && this.value < filter.min) {
            return false;
        }
        return filter.max === null || this.value <= filter.max;
    }
}

class MeasurementStats {
    /**
     * Returns null for an empty list, because there is nothing to compute.
     */
    static compute(measurements) {
        if (measurements.length === 0) {
            return null;
        }
        const values = measurements.map(measurement => measurement.value);
        const sum = values.reduce((total, value) => total + value, 0);
        return {
            min: Math.min(...values),
            max: Math.max(...values),
            average: sum / values.length
        };
    }
}

class MeasurementTable {
    static comparators = {
        newest: (a, b) => b.time.localeCompare(a.time),
        oldest: (a, b) => a.time.localeCompare(b.time),
        highest: (a, b) => b.value - a.value,
        lowest: (a, b) => a.value - b.value
    };

    constructor(table, form) {
        this.form = form;
        this.body = table.tBodies[0];
        this.unit = table.dataset.unit;
        this.measurements = Array.from(this.body.rows, row => new Measurement(row));
        this.emptyMessage = document.getElementById('noMatches');
        this.outputs = {
            count: document.getElementById('statCount'),
            min: document.getElementById('statMin'),
            max: document.getElementById('statMax'),
            average: document.getElementById('statAverage')
        };
    }

    init() {
        this.form.addEventListener('input', () => this.update());
        this.form.addEventListener('change', () => this.update());
        // Enter in a filter field must not reload the page.
        this.form.addEventListener('submit', event => event.preventDefault());
        document.getElementById('resetFilter').addEventListener('click', () => this.reset());
        this.update();
    }

    reset() {
        this.form.reset();
        this.update();
    }

    readFilter() {
        const fields = this.form.elements;
        return {
            from: fields.from.value,
            to: fields.to.value,
            min: this.readNumber(fields.min),
            max: this.readNumber(fields.max)
        };
    }

    readNumber(input) {
        return input.value === '' ? null : Number(input.value);
    }

    update() {
        const filter = this.readFilter();
        const compare = MeasurementTable.comparators[this.form.elements.sort.value];
        const visible = [];

        this.measurements.sort(compare).forEach(measurement => {
            const isVisible = measurement.matches(filter);
            measurement.row.hidden = !isVisible;
            // Appending an existing row moves it, which applies the sort order.
            this.body.appendChild(measurement.row);
            if (isVisible) {
                visible.push(measurement);
            }
        });

        this.showStats(visible);
    }

    showStats(visible) {
        const stats = MeasurementStats.compute(visible);
        this.outputs.count.textContent = `${visible.length} z ${this.measurements.length}`;
        this.outputs.min.textContent = this.formatValue(stats?.min);
        this.outputs.max.textContent = this.formatValue(stats?.max);
        this.outputs.average.textContent = this.formatValue(stats?.average);
        this.emptyMessage.hidden = visible.length > 0;
    }

    formatValue(value) {
        if (value === undefined) {
            return '-';
        }
        return `${Math.round(value * 100) / 100} ${this.unit}`;
    }
}

const measurementTable = document.getElementById('measurementTable');

// A sensor without any values has no table.
if (measurementTable !== null) {
    new MeasurementTable(measurementTable, document.getElementById('measurementFilter')).init();
}
