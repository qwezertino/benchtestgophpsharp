# Use the official Go image as the base image
FROM golang:latest as builder


# Set destination for COPY
WORKDIR /app

# Download Go modules go.sum
COPY app/golang/go.mod ./
RUN go mod download

COPY app/golang/*.go ./
# Build
RUN CGO_ENABLED=0 GOOS=linux go build -o /myapp

# Optional:
# To bind to a TCP port, runtime parameters must be supplied to the docker command.
# But we can document in the Dockerfile what ports
# the application is going to listen on by default.
# https://docs.docker.com/reference/dockerfile/#expose
EXPOSE 8101

# Run
CMD ["/myapp"]
