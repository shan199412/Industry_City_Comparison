function firstGraph(chosen_city) {

    d3.select('.svg1').selectAll("*").remove();

    var colors =d3.scale.ordinal().domain(["Agriculture, Forestry and Fishing", "Mining", "Manufacturing", "Electricity, Gas, Water & Waste Services",
        "Construction", "Wholesale trade","Retail trade","Accommodation and food services","Transport, Postal and Warehousing","Information media and telecommunications",
        "Financial and insurance services","Rental, Hiring, & Real Estate Services","Professional Scientific & Technical Services","Administrative and support services",
        "Public administration and safety","Education and training","Health care and social assistance","Arts and recreation services","Other services"])
        .range(["steelblue", "brown", "red", "green", "yellow", "grey","purple","black","blue","teal","orange","violet","aqua","azure","blueviolet",'coral','chocolate','cyan','darkred']);


    var colorScale = d3.scale.category20();
    var colorColumn = "bus_type";


    var colors = d3.scale.ordinal(d3.schemeCategory10);


    var cities = ["Agriculture, Forestry and Fishing", "Mining", "Manufacturing", "Electricity, Gas, Water & Waste Services",
        "Construction", "Wholesale trade","Retail trade","Accommodation and food services","Transport, Postal and Warehousing","Information media and telecommunications",
        "Financial and insurance services","Rental, Hiring, & Real Estate Services","Professional Scientific & Technical Services","Administrative and support services",
        "Public administration and safety","Education and training","Health care and social assistance","Arts and recreation services","Other services"]

    var color_list = []
    for (i=0;i<cities.length;i++){
        color_list.push(colorScale(cities[i]))
    };


    var color = d3.scale.ordinal()
        .range(color_list);

    var legspacing = 15

    var margin = {top: 40, right: 0, bottom: 30, left: 50},
        width = 400 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;


    function make_y_gridlines() {
        return d3.axisLeft(y)
            .ticks(5)
    }


    //console.log(chosen_city.length)
    for (i = 0; i < chosen_city.length; i++) {

        var city = chosen_city[i];

        for (z = 0; z < bus_no_data.length; z++) {
            if (bus_no_data[z]['city_id'] == city) {
                var city_name = bus_no_data[z]['city_name'];
                break;
            }
        }

        //console.log(city);
        var data = [];
        for (k = 0; k < bus_no_data.length; k++) {
            record = bus_no_data[k];
            if (record['city_id'] == city) {
                data.push(record);
            }
        }

        var formatPercent = d3.format(".0%");

        var x = d3.scale.ordinal()
            .rangeRoundBands([0, width], .1);

        var y = d3.scale.linear()
            .range([height, 0]);

        var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

        var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .innerTickSize(-width)
            .outerTickSize(0)
            .tickPadding(10);
        // .tickFormat(formatPercent);

        var tip = d3.tip()
            .attr('class', 'd3-tip')
            .offset([-10, 0])
            .html(function (d) {
                return "<strong>Business Number:</strong> <span style='color:mediumpurple'>" + d.bus_no + "</span>";
            })

        var svg = d3.select(".svg1").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        svg.call(tip);


        x.domain(data.map(function (d) {
            return d.bus_type
        }));
        y.domain([0, d3.max(data, function(d) { return parseInt(d.bus_no,10); })]);


        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis).selectAll("text").remove();

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("x",-20)
            .attr("y", -40)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .style("font-size", "12px")
            .text("Number of Business Per 10,000 People");



        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function (d) {
                return x(d.bus_type);
            })
            .attr("width", x.rangeBand())
            .attr("y", function (d) {
                return y(d.bus_no);
            })
            .attr("height", function (d) {
                return height - y(d.bus_no);
            })

            .attr("fill", function (d){ return colorScale(d[colorColumn]); })
            .attr("data-legend",function(d) { return d.bus_type})
            .on('mouseover', tip.show)
            .on('mouseout', tip.hide);


        svg.append("text")
            .attr("x", (width / 2))
            .attr("y", 0 - (margin.top / 2))
            .attr("text-anchor", "middle")
            .style("font-size", "16px")
            // .style("text-decoration", "underline")
            .text(city_name);


    }
    var svg = d3.select(".svg1").append("svg")
        .attr("width",800)
        .attr("height",250)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var legend = svg.selectAll(".legend")
        .data(cities)
        .enter()
        .append("g")
        // .attr("transform", "translate(" + width - margin.right + "," + margin.top + ")");
        .attr("transform", function(d,i) { return "translate(" + i%2 * 350 + "," + Math.floor(i/2) * 20 + ")"; })

    legend.append("rect")
        .attr("fill", color)
        .attr("width", 10)
        .attr("height", 10)
        .attr("y", function (d, i) {
            return ;
        })
        .attr("x", 5);

    legend.append("text")
        .attr("class", "label")
        .attr("y", function (d, i) {
            return 10;
        })
        .attr("x", 15)
        .attr("text-anchor", "start")
        .attr("font-size", "12px")
        .text(function (d, i) {
            return cities[i];
        });
}