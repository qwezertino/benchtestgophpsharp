# Learn about building .NET container images:
# https://github.com/dotnet/dotnet-docker/blob/main/samples/README.md
FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
WORKDIR /source

# Copy project file and restore as distinct layers
COPY app/dotnet/*.csproj .
RUN dotnet restore

# Copy source code and publish app
COPY app/dotnet/ .
# RUN dotnet publish --no-restore -o out

# Runtime stage
FROM mcr.microsoft.com/dotnet/aspnet:8.0
EXPOSE 8101
WORKDIR /app
COPY --from=build source/out .
ENTRYPOINT ["dotnet", "out/dotnet.dll"]

