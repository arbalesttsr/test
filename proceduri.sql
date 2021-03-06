/*    ==Scripting Parameters==

    Source Server Version : SQL Server 2016 (13.0.4206)
    Source Database Engine Edition : Microsoft SQL Server Express Edition
    Source Database Engine Type : Standalone SQL Server

    Target Server Version : SQL Server 2017
    Target Database Engine Edition : Microsoft SQL Server Standard Edition
    Target Database Engine Type : Standalone SQL Server
*/
USE [mpay]
GO
/****** Object:  StoredProcedure [dbo].[InsertOrderDetails]    Script Date: 9/19/2017 12:41:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[InsertOrderDetails] 
	-- Add the parameters for the stored procedure here
	@OrderKey varchar(36), 
	@OrganizationName varchar(50),
	@ServiceID varchar(36),
	@Reason varchar(50),
	@Status varchar(50),
	@TotalAmountDue decimal(20,2),
	@Currency varchar(10),
	@CustomerType varchar(36),
	@DueDate varchar(50),
	@IssuedAt varchar(50),
	@AllowPartialPayment bit,
	@AllowAdvancePayment bit,
	@CustomerID varchar(13),
	@CustomerName varchar(50),
	@AmountDue decimal(20,2)

AS
BEGIN
	Declare @ServiceIDKey as bigint;
	Declare @CurrencyKey as bigint;
	Declare @OrganizationID as bigint;

	IF NOT EXISTS (SELECT * FROM ServiceProviderOrganizations 
                   WHERE Name like @OrganizationName)
   BEGIN
       INSERT INTO ServiceProviderOrganizations (Name, Active)
		VALUES (@OrganizationName, 1)
   END

   Set  @OrganizationID = (Select ID from ServiceProviderOrganizations where Name like @OrganizationName);

   IF NOT EXISTS (SELECT * FROM OrganizationServices 
                   WHERE Name like @ServiceID and [OrganizationID] = @OrganizationID)
   BEGIN
       INSERT INTO OrganizationServices 
	   (Name, 
	   Active, 
	   PrivateCertificatePath, 
	   PublicCertificatePath, 
	   CertificatePassword, 
	   ExecuteCurrencyCode, 
	   OrganizationID )
		VALUES (@ServiceID, 1,'','','',498, @OrganizationID)
   END

	Set  @ServiceIDKey = (Select ID from OrganizationServices where Name like @ServiceID);
	Set  @CurrencyKey = (Select ID from CurrencyCode where Member like @Currency);

	Insert into OrderDetails (
		ServiceID, 
		OrderKey, 
		Reason, 
		Status, 
		IssuedAt, 
		DueDate, 
		TotalAmountDue, 
		Currency, 
		AllowPartialPayment,
		AllowAdvancePayment,
		CustomerType,
		CustomerID,
		CustomerName,
		AmountDue)
		values(
			@ServiceIDKey,
			@OrderKey,
			@Reason,
			@Status,
			@IssuedAt,
			@DueDate,
			@TotalAmountDue,
			@CurrencyKey,
			@AllowPartialPayment,
			@AllowAdvancePayment,
			@CustomerType,
			@CustomerID,
			@CustomerName,
			@AmountDue
		);

END
GO
/****** Object:  StoredProcedure [dbo].[InsertOrderDetailsPayment]    Script Date: 9/19/2017 12:41:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[InsertOrderDetailsPayment] 
	-- Add the parameters for the stored procedure here
	@OrderKey varchar(36), 
	@BankCode varchar(20),
	@BankName varchar(80),
	@BankAccount varchar(20),
	@BeneficiaryName varchar(60),
	@TreasuryAccount varchar(50)

AS
BEGIN
	Declare @OrdinID as bigint;
		
	set @OrdinID =  (Select TOP(1) ID from OrderDetails where OrderKey like @OrderKey );

	INSERT INTO [dbo].[PaymentAccountOrderDetails]
           ([OrderDetailId]
           ,[BankCode]
           ,[BankName]
           ,[TreasuryAccount]
           ,[BankAccount]
           ,[BeneficiaryName])
     VALUES
           (@OrdinID
           ,@BankCode
           ,@BankName
           ,@BankAccount
           ,@BeneficiaryName
           ,@TreasuryAccount)
END
GO
/****** Object:  StoredProcedure [dbo].[InsertOrderDetailsProperty]    Script Date: 9/19/2017 12:41:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[InsertOrderDetailsProperty]
	-- Add the parameters for the stored procedure here
	@OrderKey varchar(36), 
	@Name varchar(36),
	@DisplayName varchar(36),
	@Value text,
	@Modifiable bit,
	@Required bit

AS
BEGIN
	Declare @OrdinID as bigint;
		
	set @OrdinID =  (Select TOP(1) ID from OrderDetails where OrderKey like @OrderKey );

	INSERT INTO [dbo].[OrderPropertyOrderDetails]
           ([OrderDetailId]
           ,[Name]
           ,[DisplayName]
           ,[Value]
           ,[Modifiable]
           ,[Required])
     VALUES
           (@OrdinID
           ,@Name
           ,@DisplayName
           ,@Value
           ,@Modifiable
           ,@Required);
END
GO
