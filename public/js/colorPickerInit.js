function app() {
    return {
        isOpen: false,
        colors: ['#039be5', '#d60000', '#e67c73', '#f5511d', '#f6c026', '#33b679', '#0b8043', '#616161' ,'#3f51b5', '#7986cb', '#8e24aa'],
        colorsName : ["Peacock", "Tomato", "Flamingo", "Tangerine", "Banana", "Sage", "Basil", "Graphite","Blueberry", "Lavender", "Grape"],
        colorSelected: '#039be5',
        selectedColorName: 'Peacock',
        colorIndex: '0',

        getColorName(index) {
            this.selectedColorName = this.colorsName[index];
            this.colorIndex = index;
        },
    }
}