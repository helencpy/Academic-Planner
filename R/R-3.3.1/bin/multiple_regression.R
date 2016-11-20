args <- commandArgs(TRUE)

w_currentCGPA <- as.numeric(args[1])
w_interest <- as.numeric(args[2])
w_prediction <- as.numeric(args[3])
w_difficulty <- as.numeric(args[4])

sink('analysis-output.txt')

input<-data.frame(
student=c("001","002","003","004","005"),
currentCGPA=c(4,4,0,0,0),
interest=c(4,0,4,0,0),
prediction=c(4,0,0,4,0),
difficulty=c(4,0,0,0,4),
score=c(10,w_currentCGPA,w_interest,w_prediction,w_difficulty)
)


model<-lm(score~currentCGPA+interest+prediction+difficulty,data=input)
print(model)

# Append to the file
sink('analysis-output.txt', append=TRUE)

sink()

