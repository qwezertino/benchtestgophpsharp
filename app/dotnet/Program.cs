using Microsoft.AspNetCore.Builder;
using Microsoft.Extensions.Hosting;
using Microsoft.Extensions.DependencyInjection;
using System.Text.Json;
using System.IO;
using Item = dotnet.Item;

var builder = WebApplication.CreateBuilder(args);
var app = builder.Build();

// Define a handler for HTTP requests
app.MapGet("/", async (context) =>
{
    // Read the contents of the data.json file
    string jsonFilePath = Path.Combine(Directory.GetCurrentDirectory(), "data.json");

    if (!File.Exists(jsonFilePath))
    {
        context.Response.StatusCode = 500;
        await context.Response.WriteAsync("Error: data.json file not found.");
        return;
    }

    string json = await File.ReadAllTextAsync(jsonFilePath);

    // Parse the JSON data into a list of Item objects
    List<Item> items;
    try
    {
        items = JsonSerializer.Deserialize<List<Item>>(json);
    }
    catch (JsonException)
    {
        context.Response.StatusCode = 500;
        await context.Response.WriteAsync("Error: Could not parse JSON.");
        return;
    }

    // Return the JSON response
    context.Response.ContentType = "application/json";
    await context.Response.WriteAsJsonAsync(items);
});

// Start the server
app.Run("http://0.0.0.0:8101");
