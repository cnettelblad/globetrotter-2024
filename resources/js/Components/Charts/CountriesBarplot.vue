<script setup lang="ts">
import { onMounted, ref } from "vue";
import {
    select,
    scaleBand,
    scaleRadial,
    arc,
    scaleSequential,
    interpolateGreens,
} from "d3";
import axios from "axios";

type ResponseData = {
    id: string;
    name: string;
    emoji: string;
    type: string;
    code: string;
    submissions_count: number;
};

const chartContainer = ref<HTMLDivElement | null>(null);
const fetchData = async () => {
    const response = await axios.get(route("api.v1.submissions.countries"));
    return response.data.data as ResponseData[];
};

onMounted(async () => {
    const data = await fetchData();
    const margin = { top: 10, right: 0, bottom: 0, left: 0 };
    const width = 460 - margin.left - margin.right;
    const height = 460 - margin.top - margin.bottom;
    const innerRadius = 60;
    const outerRadius = Math.min(width, height) / 2 - 60;

    if (!chartContainer.value) return;

    // Append SVG to the chart container
    const svg = select(chartContainer.value)
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr(
            "transform",
            `translate(${width / 2 + margin.left}, ${height / 2 + margin.top})`
        );

    // Set up scales based on API data
    const x = scaleBand()
        .range([0, 2 * Math.PI])
        .align(0)
        .domain(data.map((d) => d.name));

    const maxSubmissions = Math.max(...data.map((d) => d.submissions_count));
    const y = scaleRadial()
        .range([innerRadius, outerRadius])
        .domain([0, maxSubmissions]);

    // Draw bars
    svg.append("g")
        .selectAll("path")
        .data(data)
        .join("path")
        .attr("fill", "#69b3a2")
        .attr("fill", (d) => {
            const colorScale = scaleSequential(interpolateGreens).domain([
                0,
                maxSubmissions,
            ]);
            return colorScale(d.submissions_count);
        })
        .attr(
            "d",
            arc<ResponseData>()
                .innerRadius(innerRadius)
                .outerRadius((d) => y(d.submissions_count))
                .startAngle((d) => x(d.name) as number)
                .endAngle((d) => (x(d.name) as number) + x.bandwidth())
                .padAngle(0.01)
                .padRadius(innerRadius)
        );

    // Add labels
    svg.append("g")
        .selectAll("g")
        .data(data)
        .join("g")
        .attr("text-anchor", (d) =>
            ((x(d.name) as number) + x.bandwidth() / 2 + Math.PI) %
                (2 * Math.PI) <
            Math.PI
                ? "end"
                : "start"
        )
        .attr(
            "transform",
            (d) =>
                `rotate(${
                    (((x(d.name) as number) + x.bandwidth() / 2) * 180) /
                        Math.PI -
                    90
                })translate(${y(d.submissions_count) + 10},0)`
        )
        .append("text")
        .text((d) => d.emoji)
        .attr("transform", (d) =>
            ((x(d.name) as number) + x.bandwidth() / 2 + Math.PI) %
                (2 * Math.PI) <
            Math.PI
                ? "rotate(180)"
                : "rotate(0)"
        )
        .style("font-size", "11px")
        .attr("alignment-baseline", "middle");
});
</script>

<template>
    <div ref="chartContainer" class="grid place-items-center"></div>
</template>
