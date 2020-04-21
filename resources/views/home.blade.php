@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Chart Visualization
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $chart1->options['column_class'] }}">
                            <h3>{!! $chart1->options['chart_title'] !!}</h3>
                            {!! $chart1->renderHtml() !!}
                        </div>
                        <div class="{{ $chart2->options['column_class'] }}">
                            <h3>{!! $chart2->options['chart_title'] !!}</h3>
                            {!! $chart2->renderHtml() !!}
                        </div>
                        <div class="{{ $chart3->options['column_class'] }}">
                            <h3>{!! $chart3->options['chart_title'] !!}</h3>
                            {!! $chart3->renderHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <svg id="chart-network"></svg>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart3->renderJs() !!}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.15.1/d3.min.js"></script>
<script>

    Promise.all([
        d3.json('/admin/network/nodes'),
        d3.json('/admin/network/edges'),
    ]).then(makeChart)
        .catch(function(err) {
            console.log(err);
        })

    function makeChart(data) {
        data[0].forEach(function(d, i) {
            d.group = i
        });
        //
        data[0].forEach(function(d) { //nodes
            data[1].forEach(function(e) { //edges

                if (e.source === d.case_id || e.target === d.case_id) {
                    data[0].find(function(f) {
                        return f.case_id === e.source
                    }).group = d.group;
                    data[0].find(function(f) {
                        return f.case_id === e.target
                    }).group = d.group;
                }

            })

        });

        var winheight = window.innerHeight;
        var winwidth = window.innerWidth;
        var svg = d3.select("svg");
        svg.attr("viewBox", `0 0 ` + winwidth + ` ` + winheight +``);

        var force = d3.forceSimulation()
            .force("link", d3.forceLink()
                .id(function(d) {
                    return d.case_id
                }))
            .force("charge", d3.forceManyBody().strength(-2))
            .force("collide", d3.forceCollide(25))
            .force("center", d3.forceCenter(winwidth/2, winheight/2));

        var div = d3.select("body").append("div")
            .attr("class", "tooltip")
            .style("opacity", 0);

        var edges = svg.selectAll("line")
            .data(data[1])
            .enter()
            .append("line")
            .style("stroke", "#aaa")
            .style("stroke-width", 2);

        var color = d3.scaleOrdinal(d3.schemeCategory10);

        var nodes = svg.selectAll("circle")
            .data(data[0])
            .enter()
            .append("circle")
            .attr("r", 17)
            .style("stroke", "#444")
            .style("stroke-width", 2)
            .style("fill", function(d) {
                if(d.case_id.includes("CLUSTER")) {
                    return "black";
                }
                return color(d.group);
            })
            .on("mouseover", function(d) {
                div.transition()
                    .duration(200)
                    .style("opacity", .9);
                div	.html(d.case_id)
                    .style("left", (d3.event.pageX) + "px")
                    .style("cursor", "pointer")
                    .style("top", (d3.event.pageY - 28) + "px");
            })
            .on("mouseout", function(d) {
                div.transition()
                    .duration(500)
                    .style("opacity", 0);
            });

        //
        var labels = svg.selectAll("text")
            .data(data[0])
            .enter()
            .append("text")
            .attr('text-anchor', 'middle')
            .attr('class', 'textstyle')
            .style("fill", "white")
            .text(function(d) {return d.case_id });

        force.nodes(data[0]);
        force.force("link")
            .links(data[1]);

        force.on("tick", function() {
            edges.attr("x1", function(d) {
                return d.source.x;
            })
                .attr("y1", function(d) {
                    return d.source.y;
                })
                .attr("x2", function(d) {
                    return d.target.x;
                })
                .attr("y2", function(d) {
                    return d.target.y;
                })

            nodes.attr("cx", function(d) {
                return d.x;
            })
                .attr("cy", function(d) {
                    return d.y;
                });

            labels.attr("transform", function(d) {
                return "translate(" + d.x + "," + d.y + ")";
            });


        });

    }

    // // set the dimensions and margins of the graph
    // var margin = {top: 10, right: 30, bottom: 30, left: 40},
    //     width = 300 - margin.left - margin.right,
    //     height = 400 - margin.top - margin.bottom;
    //
    // // append the svg object to the body of the page
    // var svg = d3.select("#chart-network")
    //     .attr("class","col-6 bg-dark vh-100")
    //     .append("g");
    //
    // d3.json("/admin/data-clusters", function( data) {
    //
    //     // Initialize the links
    //     var link = svg
    //         .selectAll("line")
    //         .data(data.links)
    //         .enter()
    //         .append("line")
    //         .style("stroke", "#aaa")
    //
    //     // Initialize the nodes
    //     var node = svg
    //         .selectAll("circle")
    //         .data(data.nodes)
    //         .enter()
    //         .append("circle")
    //         .attr("r", 20)
    //         .style("fill", "#69b3a2")
    //
    //     // Let's list the force we wanna apply on the network
    //     var simulation = d3.forceSimulation(data.nodes)                 // Force algorithm is applied to data.nodes
    //         .force("link", d3.forceLink()                               // This force provides links between nodes
    //             .id(function(d) { return d.id; })                     // This provide  the id of a node
    //             .links(data.links)                                    // and this the list of links
    //         )
    //         .force("charge", d3.forceManyBody().strength(-400))         // This adds repulsion between nodes. Play with the -400 for the repulsion strength
    //         .force("center", d3.forceCenter(width / 2, height / 2))     // This force attracts nodes to the center of the svg area
    //         .on("end", ticked);
    //
    //     // This function is run at each iteration of the force algorithm, updating the nodes position.
    //     function ticked() {
    //         link
    //             .attr("x1", function(d) { return d.source.x; })
    //             .attr("y1", function(d) { return d.source.y; })
    //             .attr("x2", function(d) { return d.target.x; })
    //             .attr("y2", function(d) { return d.target.y; });
    //
    //         node
    //             .attr("cx", function (d) { return d.x+6; })
    //             .attr("cy", function(d) { return d.y-6; });
    //     }
    //
    // });


</script>
@endsection
